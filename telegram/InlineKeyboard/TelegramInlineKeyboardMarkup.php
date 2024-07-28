<?php
/**
 * @PHP       Version >= 8.0
 * @Liberary  TelegramBot
 * @Project   TelegramBot
 * @copyright ©2024 Maatify.dev
 * @see       https://www.maatify.dev Visit Maatify.dev
 * @link      https://github.com/Maatify/TelegramBot View project on GitHub
 * @since     2024-07-28 8:35 AM
 * @author    Mohamed Abdulalim (megyptm) <mohamed@maatify.dev>
 * @Maatify   TelegramBot :: TelegramUpdates
 * @note      This Project using for Call Telegram API
 *
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

namespace Maatify\TelegramBot\InlineKeyboard;

class TelegramInlineKeyboardMarkup
{

    private static self $instance;

    public static function obj(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    private array $keyboard = [];
    /**
     * Create an inline keyboard markup for Telegram messages.
     *
     * This method takes a 2D array of buttons and converts it into a JSON-encoded
     * string that represents an inline keyboard markup for Telegram.
     *
     * @param array $buttons A 2D array where each sub-array represents a row of buttons.
     *                       Each button should be an associative array with 'text' and 'callback_data' keys.
     *                       Example:
     *                       [
     *                           [
     *                               ['text' => 'Button 1', 'callback_data' => 'action1'],
     *                               ['text' => 'Button 2', 'callback_data' => 'action2']
     *                           ],
     *                           [
     *                               ['text' => 'Button 3', 'callback_data' => 'action3']
     *                           ]
     *                       ]
     *
     * @return string JSON-encoded string representing the inline keyboard markup
     */
    public function createInlineKeyboard(array $buttons): string
    {
        $keyboard = [];
        foreach ($buttons as $row) {
            $keyboardRow = [];
            foreach ($row as $button) {
                $keyboardRow[] = [
                    'text' => $button['text'],
                    'callback_data' => $button['callback_data']
                ];
            }
            $keyboard[] = $keyboardRow;
        }

        return json_encode(['inline_keyboard' => $keyboard]);
    }

    /**
     * Add a button to the current row of the inline keyboard
     *
     * @param string $text The text of the button
     * @param string $callback_data The callback data to be sent when the button is pressed
     */
    public function addButton(string $text, string $callback_data): void
    {
        $this->keyboard[] = [['text' => $text, 'callback_data' => $callback_data]];
    }

    /**
     * Create a new row in the inline keyboard
     */
    public function newRow(): void
    {
        $this->keyboard[] = [];
    }

    /**
     * Get the inline keyboard as an array
     *
     * @return array The inline keyboard
     */
    public function getInlineKeyboard(): array
    {
        return ['inline_keyboard' => $this->keyboard];
    }

    /**
     * Get the inline keyboard as JSON
     *
     * @return string The inline keyboard in JSON format
     */
    public function getInlineKeyboardJson(): string
    {
        return json_encode(['inline_keyboard' => $this->keyboard]);
    }
}