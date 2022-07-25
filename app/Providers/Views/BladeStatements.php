<?php

namespace App\Providers\Views;

use Illuminate\Support\Facades\Blade;

trait BladeStatements
{

    public function bootBladeStatements(): void
    {
        $this->bootDirectiveDate()
            ->bootDirectiveMoney();
    }

    /**
     * @param null $format
     * @return $this
     */
    private function bootDirectiveDate($format = null): static
    {
        Blade::directive('date', function ($expression) use ($format) {
            $format = $format ?: 'd.m.Y';
            return "<?php echo ($expression)->format('$format'); ?>";
        });

        return $this;
    }

    /**
     * @return $this
     */
    private function bootDirectiveMoney(): static
    {
        Blade::directive('money', function ($expression) {
            $currency = config('app.currency', '$');
            return "<?php echo ('$currency ' . $expression); ?>";
        });

        return $this;
    }

}
