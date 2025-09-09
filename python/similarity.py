import sys
from sentence_transformers import SentenceTransformer, util

model = SentenceTransformer('all-MiniLM-L6-v2')

text1 = sys.argv[1]
text2 = sys.argv[2]

emb1 = model.encode(text1, convert_to_tensor=True)
emb2 = model.encode(text2, convert_to_tensor=True)

score = util.pytorch_cos_sim(emb1, emb2).item()
print(score)
