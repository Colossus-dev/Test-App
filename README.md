# Laravel Shop API (Docker)

Минимальный интернет‑магазин на **Laravel**. Реализованы модели `User`, `Order`, `Product`, таблица `order_product`, миграции, сидеры и контроллер для заказов.

---

## Быстрый старт

### 1. Клонирование

```bash
git clone https://github.com/Colossus-dev/Test-App.git
cd <repo>
```

### 2. Запуск Docker

```bash
cp .env.example .env
docker compose up -d --build
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```

### 3. Доступ к API

API доступно по адресу:
`http://localhost:8000/api/`

---

## Маршруты

* `GET /api/orders` — список заказов
* `GET /api/orders/{id}` — детали заказа
* `POST /api/orders` — создать заказ
* `PUT /api/orders/{id}/status` — изменить статус
* `DELETE /api/orders/{id}` — удалить заказ

---

## Примеры cURL

Список заказов:

```bash
curl http://localhost:8000/api/orders
```

Детали заказа:

```bash
curl http://localhost:8000/api/orders/1
```

Создать заказ:

```bash
curl.exe -X POST "http://127.0.0.1:8000/api/orders" --header "Content-Type: application/json" --header "Accept: application/json" --data-binary '{"user_id":4,"products":[{"id":6,"quantity":1},{"id":8,"quantity":2}]}'
```

Изменить статус:

```bash
curl.exe -X PUT http://localhost:8000/api/orders/1/status \
  -H "Content-Type: application/json" \
  -d '{"status": "processed"}'
```

Удалить заказ:

```bash
curl -X DELETE http://localhost:8000/api/orders/1
```

---

## Тесты

Запуск:

```bash
docker compose exec app php artisan test
```

---

## Ссылка на репозиторий

Замените плейсхолдер на реальный URL вашего GitHub:

```
https://github.com/Colossus-dev/Test-App
```
