## Articles

### Создание артикула

POST api/articles/{id} 

Параметры | Тип | Описание
------------ | ------------- | -------------
id | int | * Параметр в url, идентификатор товара 
name | string | * Название товара, не менее 2 символов
description | text |  *
count | int/null/'' |  количество 

Пример ответа

```
{
  "id": 0,
  "category": {
    "id": 0,
    "name": "string"
  },
  "name": "doggie",
  "photoUrls": [
    "string"
  ],
  "tags": [
    {
      "id": 0,
      "name": "string"
    }
  ],
  "status": "available"
}
```

Код ответа | Описание
------------ | ------------- 
400 | Недопустимый id
404 | Артикул не найден

### Обновление артикула

PUT api/articles/{id} 

Параметры | Тип | Описание
------------ | ------------- | -------------
id | int | * Параметр в url, идентификатор товара 
name | string | * Название товара, не менее 2 символов
description | text |  *
count | int/null/'' |  количество 

Пример ответа

```
{
  "id": 0,
  "category": {
    "id": 0,
    "name": "string"
  },
  "name": "doggie",
  "photoUrls": [
    "string"
  ],
  "tags": [
    {
      "id": 0,
      "name": "string"
    }
  ],
  "status": "available"
}
```

Код ответа | Описание
------------ | ------------- 
400 | Недопустимый id
404 | Артикул не найден
