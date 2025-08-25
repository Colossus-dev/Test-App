@echo off
echo Создание нового заказа...
curl -X POST http://127.0.0.1:8000/orders/create ^
  -H "Content-Type: application/x-www-form-urlencoded" ^
  -d "user_id=1&products[0][id]=1&products[0][quantity]=2&products[1][id]=2&products[1][quantity]=1"

echo ------------------------------
echo Получение списка заказов
curl  http://127.0.0.1:8000/orders

echo ------------------------------
echo Получение деталей заказа ID 1.
curl http://127.0.0.1:8000/orders/1

echo ------------------------------
echo Обновление статуса заказа ID 1 на 'processed'
curl -X PATCH http://127.0.0.1:8000/orders/1/status ^
  -H "Content-Type: application/x-www-form-urlencoded" ^
  -d "status=processed"

echo ------------------------------
echo Удаление заказа ID 1.
curl.exe -X DELETE http://127.0.0.1:8000/orders/1
