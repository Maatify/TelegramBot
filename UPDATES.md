
#
### Updates
###### Get All Updates
###### (To get the list of updates, the web Hook should not be set)
```php
$response = $telegram->GetUpdates(); // get updates

print_r($response);
```

### Initiate Update
###### Set Update from All Updates
```php
$update = $telegram->LastUpdate(); // get Last Update
// OR
$update = $telegram->FirstUpdate(); // get First Update
// OR
$update = $telegram->Update(1); // get Index Update
```

### Get Message
###### Get Message Array from Initiated Update
```php
$response = $update->GetMessage();

print_r($response);
```

### Get Message Info from Update
###### Get Message Info from Initiated Update
```php
$message_id     = $update->UpdateID();      // get Message Update ID  (int)
$message_id     = $update->GetMessageID();  // get Message ID  (int)
$message_array  = $update->GetMessage();    // get message array (array)
$from_array     = $update->GetFrom();       // get message from array (array)
$chat_array     = $update->GetChat();       // get message chat array (array)
$text           = $update->GetText();       // get message text (string)
$date           = $update->GetDate();       // get message Date as timestamp (int)
```

### Get From of Message
###### Get From Info from Initiated Update
```php

$from_obj           = $update->From();
$from_array         = $update->GetFrom();        // get message from array (array)
$from_id            = $from_obj->ID();           // get sender id from message array (int)
$from_is_bot        = $from_obj->IsBot();        // get sender is_bot from message array (bool)
$from_first_name    = $from_obj->FirstName();    // get sender first_name from message array (string)
$from_last_name     = $from_obj->LastName();     // get sender last_name from message array (string)
$from_username      = $from_obj->Username();     // get sender username from message array (string)
$from_username      = $from_obj->LanguageCode(); // get sender language_code from message array (string)
```

### Get Chat of Message
###### Get Chat Info from Initiated Update
```php
$chat_obj           = $update->Chat();
$chat_array         = $update->GetChat();      // get chat from array (array)
$chat_id            = $chat_obj->ID();         // get chat id from array (int)
$chat_first_name    = $chat_obj->FirstName();  // get chat first_name from array (string)
$chat_last_name     = $chat_obj->LastName();   // get chat last_name from array (string)
$chat_username      = $chat_obj->Username();   // get chat username from array (string)
$chat_type          = $chat_obj->Type();       // get chat type from array (string)
```

### Get forward_from_chat of Message
###### Get forward_from_chat Info from Initiated Update
```php
$forward_from_message_obj       = $update->ForwardFromMessage();
$forward_from_chat              = $forward_from_message_obj->GetForwardChat();          // Get chat info from forward_from_message of message (array)
$forward_from_chat_id           = $forward_from_message_obj->GetForwardChatId();        // Get chat id from forward_from_message of message (int)
$forward_from_chat_first_name   = $forward_from_message_obj->GetForwardChatFirstName(); // Get chat first name from forward_from_message of message (string)
$forward_from_chat_last_name    = $forward_from_message_obj->GetForwardChatLastName();  // Get chat last name from forward_from_message of message (string)
$forward_from_chat_username     = $forward_from_message_obj->GetForwardChatUsername();  // Get chat username from forward_from_message of message (string)
$forward_from_chat_type         = $forward_from_message_obj->GetForwardChatType();      // Get chat type from forward_from_message of message (string)
$forward_from_chat_message_id   = $forward_from_message_obj->GetForwardFromMessageId(); // Get chat message id from forward_from_message of message (int)
$forward_from_chat_signature    = $forward_from_message_obj->GetForwardSignature();     // Get chat signature from forward_from_message of message (string)
$forward_from_chat_date         = $forward_from_message_obj->GetForwardFromDate();      // Get chat date from forward_from_message of message (int)
```

### Get reply_to_message of Message
###### Get reply_to_message Info from Initiated Update
```php
$chat_reply_to_message_obj = $update->ReplyToMessage();
$from_obj           = $chat_reply_to_message_obj->From();           // Get from info from reply_to_message of message (array)
$message_id         = $chat_reply_to_message_obj->GetMessageID();   // Get message id from reply_to_message of message (int)
$from_id            = $from_obj->ID();                              // get sender id from reply_to_message array (int)
$from_is_bot        = $from_obj->IsBot();                           // get sender is_bot from reply_to_message array (bool)
$from_first_name    = $from_obj->FirstName();                       // get sender first_name from reply_to_message array (string)
$from_last_name     = $from_obj->LastName();                        // get sender last_name from reply_to_message array (string)
$from_username      = $from_obj->Username();                        // get sender username from reply_to_message array (string)
$from_language_code = $from_obj->LanguageCode();                    // get sender language_code from reply_to_message array (string)
```
#
## Get Messages With Groups
###### Get Message array from All Updates With Group By Type
```php
$grouped                    = $telegram->UpdatesGrouped();
$updates_by_chat_id         = $grouped->ByChatID();     // get updates Grouped by chat id
$updates_by_chat_username   = $grouped->ByUsername();   // get updates Grouped by chat username
$updates_by_chat_first_name = $grouped->ByFirstName();  // get updates Grouped by chat first_name
```
