<?php

namespace App\Providers\Views;

use Illuminate\Support\Facades\Blade;

trait BladeStatements
{

    public function bootBladeStatements()
    {
        $this->bootDirectiveDate();
        $this->bootDirectiveMoney();
    }

    /**
     * @param null $format
     *
     * @date($date, 'd.m.Y')
     */
    private function bootDirectiveDate($format = null)
    {
        Blade::directive('date', function ($expression) use ($format) {
            $format = $format ?: 'd.m.Y';
            return "<?php echo ($expression)->format('$format'); ?>";
        });
    }

    /**
     * @money($value)
     */
    private function bootDirectiveMoney()
    {
        Blade::directive('money', function ($expression) {
            $currency = config('app.currency', '$');
            return "<?php echo ('$currency ' . $expression); ?>";
        });
    }

}