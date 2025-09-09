#!/usr/bin/env python3
import sys
import json

def tfidf_fallback(a, b):
    import re, math
    def tokenize(s):
        return re.findall(r'\w+', s.lower())
    def vec(tokens):
        v={}
        for t in tokens:
            v[t]=v.get(t,0)+1
        return v
    va = vec(tokenize(a))
    vb = vec(tokenize(b))
    words = set(va.keys()) | set(vb.keys())
    dot = sum(va.get(w,0)*vb.get(w,0) for w in words)
    noa = math.sqrt(sum(v*v for v in va.values()))
    nob = math.sqrt(sum(v*v for v in vb.values()))
    if noa == 0 or nob == 0:
        return 0.0
    return dot / (noa * nob)

def main():
    try:
        data = json.load(sys.stdin)
        a = data.get('text1', '')
        b = data.get('text2', '')
    except Exception:
        print(json.dumps({"error": "invalid input"}))
        return

    try:
        from sentence_transformers import SentenceTransformer, util
        model = SentenceTransformer('all-MiniLM-L6-v2')
        emb1 = model.encode(a, convert_to_tensor=True)
        emb2 = model.encode(b, convert_to_tensor=True)
        score = util.pytorch_cos_sim(emb1, emb2).item()
    except Exception:
        try:
            from sklearn.feature_extraction.text import TfidfVectorizer
            from sklearn.metrics.pairwise import cosine_similarity
            vectorizer = TfidfVectorizer()
            tfidf = vectorizer.fit_transform([a, b])
            score = float(cosine_similarity(tfidf[0:1], tfidf[1:2])[0][0])
        except Exception:
            score = tfidf_fallback(a, b)

    print(json.dumps({"similarity": float(score)}))

if __name__ == "__main__":
    main()
