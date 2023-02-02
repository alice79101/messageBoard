<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "修改會員資料"
]);
?>

    <main>
        <div class="mx-auto w-full max-w-7xl py-6 sm:px-6 lg:px-8">
<!--            <div class="md:grid md:grid-cols-3 md:gap-6">-->
<!--                <div class="mt-5 md:col-span-2 md:mt-0">-->

                    <form class="w-full max-w-sm" method="post">
<!--                        <form class="w-full max-w-sm" action="#" method="post">-->
                        <div class="shadow sm:overflow-hidden sm:rounded-md">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                               for="userID">使用者帳號</label>
                                    </div>
                                    <div class="md:w-2/3">
                                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                               id="userID" name="userID" type="text" value="<?= $user["userID"]; ?>">
                                    </div>
                                </div>
                                <a class="text-red-500"><?= (empty($errMsg["userID"])) ? "": $errMsg["userID"] ?></a>
                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                               for="nickname">使用者暱稱</label>
                                    </div>
                                    <div class="md:w-2/3">
                                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                               id="nickname" name="nickname" type="text" value="<?= $user["nickname"]; ?>">
                                    </div>
                                </div>
                                <a class="text-red-500"><?= (empty($errMsg["nickname"])) ? "": $errMsg["nickname"] ?></a>
                                <a class="text-red-500"><?= (empty($errMsg["emptyInput"])) ? "": $errMsg["emptyInput"] ?></a>
                                <input id="memberID" name="memberID" type="hidden" value="<?= $user["memberID"]; ?>">
                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                               for="password">密碼</label>
                                    </div>
                                    <div class="md:w-2/3">
                                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                               id="password" name="password" type="password" placeholder="******************">
                                    </div>
                                </div>
                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                               for="passwordRepeat">修改密碼請再次輸入</label>
                                    </div>
                                    <div class="md:w-2/3">
                                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                                               id="passwordRepeat" name="passwordRepeat" type="password" placeholder="******************">
                                    </div>
                                </div>
                                <a class="text-red-500"><?= (empty($errMsg["password"])) ? "": $errMsg["password"] ?></a>
                                <div class="md:flex md:items-center mb-6">
                                    <div class="md:w-1/3">
                                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                                               for="admin">會員資格</label>
                                    </div>
                                    <div class="relative w-64 md-flex">
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                id="admin" name="admin">
                                            <?php if ($user["ADMIN"] === 1) { ?>
                                                <option>管理員</option>
                                                <option>一般會員</option>
                                            <?php } else { ?>
                                                <option>一般會員</option>
                                                <option>管理員</option>
                                            <?php } ?>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 20 20">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button type="delete" name="delete"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" action="/deleteMember?<?= $user["memberID"]; ?>" >
                                        危險：刪除會員帳號
                                    </button>

                                    <button type="update" name="update"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" action="/updateMember?<?= $user["memberID"]; ?>">
                                        修改會員資料
                                    </button>
                                </div>
                            </div>
                    </form>


<!--                </div>-->
<!--            </div>-->
        </div>
        <?php if (isset($_POST["update"])) { ?>
            <a><?= ($updateStatus === "YES") ? "修改成功！" : "修改失敗"; ?><br></a>
        <?php } ?>
        <a href="/admin" class="text-blue-500 hover:underline">回到會員清單...</a>
        <!-- /End replace -->
    </main>


<?php
view_path("partials/footer.php");
?>