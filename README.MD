
# Installation

```shell
composer require maatify/telegram-bot
```
https://core.telegram.org/bots/api#available-methods // telegram api references

# Usage

### Instance
```php
use Maatify\TelegramBot\TelegramBotManager;

require __DIR__ . '/vendor/autoload.php';

$telegram = TelegramBotManager::obj(__YOUR_API_KEY__); // instance of bot manager
```

### GetMe
###### Get Bot Information
A simple method for testing your bot's authentication token. Requires no parameters. Returns basic information about the bot in form of a User object.
```php
$response = $telegram->Methods()->GetMe(); // get bot account information

print_r($response);
```

### logOut
Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
```php
$logout = $telegram->Methods()->Logout();
print_r($logout);
```
### Close
Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns True on success. Requires no parameters.
```php
$close = $telegram->Methods()->Close();
print_r($close);
```

# Webhook
- WEBHOOK Usage and examples - [WEBHOOK.md](WEBHOOK.md)
- Sending Files, Messages, Actions examples - [SENDER.md](SENDER.md)

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

### Get Messages With Groups
###### Get Message array from All Updates With Group By Type
```php
$grouped                    = $telegram->UpdatesGrouped();
$updates_by_chat_id         = $grouped->ByChatID();     // get updates Grouped by chat id
$updates_by_chat_username   = $grouped->ByUsername();   // get updates Grouped by chat username
$updates_by_chat_first_name = $grouped->ByFirstName();  // get updates Grouped by chat first_name
```

### GetChat
###### Get Chat By chat_id
```php
$chat = $telegram->GetChat(123456); // set getChat by chat_id

$by_chat                = $chat->Get();                 // get array of getChat
$chat_id                = $chat->GetID();               // get id from getChat by chat_id
$chat_first_name        = $chat->GetFirstName();        // get first_name from getChat
$chat_last_name         = $chat->GetLastName();         // get last_name from getChat
$chat_username          = $chat->GetUsername();         // get username from getChat
$chat_type              = $chat->GetType();             // get type from getChat
$chat_active_username   = $chat->GetActiveUsername();   // get array of active_username from getChat
```

#
## getUserProfilePhotos
Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
```php
try {
    $telegram->Downloader()->DownloadUserProfilePhotos($user_id);
} catch (Exception $e) {
    print_r($e->getMessage());
}
```

