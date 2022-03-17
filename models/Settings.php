<?php namespace Frukt\Frushop\Models;

use Model;

/**
 * Settings Model
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'frukt_frushop_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}
