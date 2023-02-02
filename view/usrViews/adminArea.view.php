<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "管理者專區"
]);
?>

    <main>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
                <?php
                if ($_SESSION["ADMIN"] !== 1) { ?>
                    <a href="/"
                       class="text-blue-500 inline-block hover:border-b border-blue-900">您無此權限，回到首頁</a>
                <?php } else { ?>
                    <form action="#" method="POST">
                        <div class="py-2 inline-block w-screen min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="table-fixed">
                                    <thead class="bg-white border-b">
                                    <tr>
                                        <th class="w-1/8 text-sm font-medium text-gray-900 px-6 py-4 text-medium">序號
                                        </th>
                                        <th class="w-1/8 text-sm font-medium text-gray-900 px-6 py-4 text-medium">
                                            使用者暱稱
                                        </th>
                                        <th class="w-3/8 text-sm font-medium text-gray-900 px-6 py-4 text-medium">
                                            使用者帳號
                                        </th>
                                        <th class="w-1/8 text-sm font-medium text-gray-900 px-6 py-4 text-medium">
                                            管理者身份
                                        </th>
                                        <th class="w-2/8 text-sm font-medium text-gray-900 px-6 py-4 text-medium">
                                            帳號管理
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($userList as $k => $value) { ?>
                                        <tr class="bg-gray-100 border-b">
                                            <td class="w-1/8 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= ($k + 1); ?></td>
                                            <td class="w-1/8 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($value["nickname"]); ?></td>
                                            <td class="w-3/8 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?= $value["userID"]; ?></td>
                                            <td class="w-1/8 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <?php
                                                if ($value["ADMIN"] === 1) { ?>
                                                    管理者
                                                <?php }; ?>
                                            </td>
                                            <td class="w-2/8 text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <a href="/updateMember?memberID=<?= $value['memberID'] ?>"
                                                   class="text-gray-500 inline-block hover:border-b border-gray-900">修改</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
            <br>
        </div>
    </main>
<?php
view_path("partials/footer.php");
?>