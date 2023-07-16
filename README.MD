
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

# Sender
- Sending Files, Messages, Actions examples - [SENDER.md](SENDER.md)

# Updates
- (To get the list of updates, the web Hook should not be set) examples - [UPDATES.md](UPDATES.md)


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

