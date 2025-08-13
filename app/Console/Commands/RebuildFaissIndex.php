<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;


class RebuildFaiss extends Command
{
    protected $signature = 'faiss:rebuild';
    protected $description = 'إعادة بناء فهرس FAISS كل 12 ساعة';

    public function handle()
    {
        $this->info("🔄 جاري إعادة بناء الفهرس...");

        // مسار مجلد Python project
        $path = 'C:\Users\admin\Desktop\information retrival';

        // أوامر Python
        $commands = [
            'python db_to_docs.py',
            'python retrieval.py'
        ];

        foreach ($commands as $cmd) {
            $process = Process::fromShellCommandline($cmd, $path);
            $process->setTimeout(3600); // ⏳ وقت كافي للتنفيذ
            $process->run(function ($type, $buffer) {
                echo $buffer; // طباعة أي مخرجات أو أخطاء
            });

            if (!$process->isSuccessful()) {
                $this->error("❌ فشل تنفيذ الأمر: $cmd");
                return Command::FAILURE;
            }
        }

        $this->info("✅ تمت إعادة بناء الفهرس بنجاح!");
        return Command::SUCCESS;
    }
}
