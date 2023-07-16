<?php
/**
 * Created by Maatify.dev
 * User: Maatify.dev
 * Date: 2024-07-28
 * Time: 8:35 AM
 * https://www.Maatify.dev
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
    public function createInlineKeyboard(array $buttons): array
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

//        return json_encode(['inline_keyboard' => $keyboard]);
        return $keyboard;
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