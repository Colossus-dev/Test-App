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
`http://localhost:8080/`

---

## Маршруты

* `GET /orders` — список заказов
* `GET /orders/{id}` — детали заказа
* `POST /orders` — создать заказ
* `PUT /orders/{id}/status` — изменить статус
* `DELETE /orders/{id}` — удалить заказ

---

## Примеры cURL

Список заказов:

```bash
curl http://localhost:8080/orders
```

Детали заказа:

```bash
curl http://localhost:8080/orders/1
```

Создать заказ:

```bash
curl -X POST http://localhost:8080/orders \
  -H "Content-Type: application/json" \
  -d '{
    "user_id": 1,
    "items": [
      {"product_id": 2, "quantity": 1},
      {"product_id": 3, "quantity": 2}
    ]
  }'
```

Изменить статус:

```bash
curl -X PUT http://localhost:8080/orders/1/status \
  -H "Content-Type: application/json" \
  -d '{"status": "processed"}'
```

Удалить заказ:

```bash
curl -X DELETE http://localhost:8080/orders/1
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
