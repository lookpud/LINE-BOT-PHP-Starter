
curl -X POST \
-H 'Content-Type:application/json' \
-H 'Authorization: Bearer {mp9W1fQUWXhFHXoIzL7fGy0sW55YeJX3w+2/q/L7zeQa4Ouk/xK1aUypnqo0lFg9hN5GyFN/v/HmDARGeep1o9Pm8kEzQ/h6JA8kxwFAxXUvmF7cEaPm9u6/pMdFWay5FEc35vYlxceDLvixuLzmSwdB04t89/1O/w1cDnyilFU=}' \
-d '{
     "to": "U5c95645df3a889a8a270bd48e8a803c5",
     "messages":[
          {
               "type":"text",
               "text":"Hello, PGame"
          },
          {
               "type":"text",
               "text":"Are you hungry?"
          }
      ]
}' https://api.line.me/v2/bot/message/push

