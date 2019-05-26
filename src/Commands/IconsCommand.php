<?php
/**
 * Created by PhpStorm.
 * User: kuzyt
 * Date: 22.05.2019
 */

namespace KuzyT\Halfdream\Commands;

use Illuminate\Console\Command;
use KuzyT\Halfdream\Models\Icon;
use Symfony\Component\Console\Input\InputOption;

class IconsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'halfdream:icons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate JS for icons from DB.';

    /**
     * Get user options.
     */
    protected function getOptions()
    {
        return [
            ['display', null, InputOption::VALUE_NONE, 'Display generated js.', null],
        ];
    }

    public function fire()
    {
        return $this->handle();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $icons = Icon::whereIn('type', Icon::getFATypes())->get();
            $content = view('halfdream::general.icons.jstemplate', compact('icons'))->render();
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            exit;
        }

        if ($this->option('display')) {
            $this->displayContent($content);
        } else {
            // Now there is simple file_put_contents, no Laravel Storage, cause it is path from bas_path
            try {
                file_put_contents(base_path(config('halfdream.modules.icons.js_path')), $content);
            } catch (\Exception $exception) {
                $this->error($exception->getMessage());
                exit;
            }
            $this->line(__('halfdream::commands.icons.complete', ['path' => config('halfdream.modules.icons.js_path')]));
        }
    }

    /**
     * Display generated js.
     *
     * @param $content
     */
    protected function displayContent($content)
    {
        $this->info('<script>');
        $this->line($content);
        $this->info('</script>');
    }
}
