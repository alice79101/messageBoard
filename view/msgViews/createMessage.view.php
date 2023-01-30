<?php
view_path("partials/head.php");
view_path("partials/nav.php");
view_path("partials/banner.php", [
    'heading' => "Create Message"
]);
?>

    <main>
        <div class="mx-auto w-full max-w-7xl py-6 sm:px-6 lg:px-8">
            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="mt-5 md:col-span-2 md:mt-0">
                        <form action="#" method="POST">
                            <div class="shadow sm:overflow-hidden sm:rounded-md">
                                <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
                                    <div>
                                        <label for="Title"
                                               class="block text-sm font-medium text-gray-700">Title</label>
                                        <div class="mt-1">
                                            <textarea id="Title" name="Title" rows="1"
                                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                      placeholder="訊息標題"><?php
                                                if (isset($_POST['Title']) && $createStatus === "NO") {
                                                    echo htmlspecialchars($_POST['Title']);
                                                }
                                                ?></textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="content"
                                               class="block window-full text-sm font-medium text-gray-700">Content</label>
                                        <div class="mt-1">
                                        <pre><textarea id="content" name="content" rows="3"
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                  placeholder="留點話吧～"><?php
                                            if (isset($_POST['content']) && $createStatus === "NO") {
                                                echo htmlspecialchars($_POST['content']);
                                            }
                                                ?></textarea></pre>
                                        </div>
                                    </div>


                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                                    <button type="submit"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        送出
                                    </button>
                                </div>
                            </div>
                        </form>
                        <a><?= $createStatus === "YES" ? "留言成功！" : $errMsg; ?><br></a>
                        <a href="/myMessage" class="text-blue-500 hover:underline">Back...</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /End replace -->
    </main>


<?php
view_path("partials/footer.php");
?>