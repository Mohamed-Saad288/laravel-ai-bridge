# AI Bridge for Laravel

**AI Bridge** is a Laravel package that allows you to run Python scripts (such as text similarity checks) inside Laravel using the `symfony/process` component.

---

## 🚀 Installation

1. Install the package via Composer:

```bash
composer require mohamedsaad/ai-bridge
```

Or, if you are still developing locally:

```bash
composer require mohamedsaad/ai-bridge:@dev
```

Laravel will auto-discover the `AiServiceProvider`.  
If needed, you can also add it manually in `config/app.php`.

---

## ⚙️ Usage

Example: Run a Python similarity script

```php
use Saad\AiBridge\AiBridge;

$result = AiBridge::runPython('similarity.py', [
    'text1' => 'I love programming',
    'text2' => 'I enjoy coding'
]);

dd($result);
```

- Place your Python scripts inside the `python/` folder (e.g., `similarity.py`).
- PHP will pass arguments to Python, and the script should return output (text or JSON).

---

## 📂 Project Structure

```
.
├── src/               # Core PHP package code
├── python/            # Python scripts
├── composer.json
└── README.md
```

---

## 👨‍💻 Author

Mohamed Saad  
[mohamed.saadd@gmail.com](mailto:mohamed.saadd@gmail.com)

---

## 📜 License

This package is open-sourced software licensed under the MIT license.
