# AI Bridge for Laravel

AI Bridge is a Laravel package that allows you to check the semantic similarity between two texts using Python and Sentence Transformers.

It provides a simple PHP service and Laravel integration while running Python under the hood.

---

## 🚀 Features

- **Semantic text similarity** (not just string matching).
- Uses [sentence-transformers](https://www.sbert.net/) (`all-MiniLM-L6-v2`) for embeddings.
- Easy to use inside Laravel via the service container or facade.
- Built-in Python script execution with Symfony Process.

---

## 📦 Installation

1. **Install the package via Composer:**

   ```bash
   composer require mohamedsaad/ai-bridge
   ```

2. **Make sure you have Python 3.8+ installed.**

3. **Install the Python dependencies:**

   ```bash
   pip install sentence-transformers torch
   ```

---

## ⚡ Usage

### Using the Service

```php
use Saad\AiBridge\AiService;

$ai = app(AiService::class);

$score = $ai->similarity("I love programming", "I enjoy coding");

echo $score; // 0.85 (the closer to 1, the more similar)
```

### Using the Facade

```php
use Facades\Ai;

$score = Ai::similarity("Laravel is great", "I like PHP frameworks");

dd($score);
```

---

## 🛠 Requirements

- PHP >= 8.1
- Laravel >= 10
- Python >= 3.8
- Python Packages: `sentence-transformers`, `torch`

---

## 📌 Example Output

- **Input:** `"I love programming"` vs `"I enjoy coding"`
- **Output:** `0.82`

---

## 📝 License

This package is open-sourced software licensed under the [MIT license](LICENSE).
