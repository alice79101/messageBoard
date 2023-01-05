<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">

        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <p>
                Here are latest messages.
            </p>
                <ul>
                    <?php foreach ($latestMsg as $k=>$value) : ?>
                    <div class="h-20 rounded-lg border-2 border-dashed border-gray-200">
                    <li class="mt-4">
<!--                        --><?php //var_dump($value); ?>
                        <li class="text-gray-500 hover:underline"><?php
                            if (strlen($value['msgTitle']) <= 100 ) {
                                $result = $value['msgTitle'];
                            } else {
                                $result = substr($value['msgTitle'], 0, 30) . "...";
                            }
                            echo $result; ?>
                        </li>
                        <li align="right">
                           <?= "｜ 發佈於：" . substr($value["msgTime"], 0, 10); ?>
                        </li>
                        <br>
                        <?php endforeach; ?>
                    </li>
                    </div>
                </ul>
        </div>
        <!-- /End replace -->

    </div>
</main>