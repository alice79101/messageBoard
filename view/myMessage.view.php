<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Replace with your content -->
        <div class="px-4 py-6 sm:px-0">
            <p>
                click to read content or manage it.
            </p>
            <ul>
                <?php foreach ($myMsg as $k=>$value) : ?>
                <div>
                    <a href=""></a>
                    <li class="text-gray-500 hover:underline"><?php
                        if (strlen($value['msgTitle']) <= 100 ) {
                            $result = $value['msgTitle'];
                        } else {
                            $result = substr($value['msgTitle'], 0, 30) . "...";
                        }
                        echo $result; ?>
                    </li>
                    <?php endforeach; ?>
                </div>
            </ul>
        </div>
        <!-- /End replace -->

    </div>
</main>