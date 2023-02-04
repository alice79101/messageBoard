<nav class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-8 w-8" src="https://cdn-icons-png.flaticon.com/512/4611/4611684.png" alt="Logo">
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <?php
                        $thisPage = "bg-gray-900 text-white";
                        $thatPage = "text-gray-300 hover:bg-gray-700 hover:text-white";
                        ?>
                        <a href="/" class="<?= isUrl("/") ? $thisPage : $thatPage ; ?> px-3 py-2 rounded-md text-sm font-medium">Home</a>
                        <a href="/latest" class="<?= isUrl("/latest") ? $thisPage : $thatPage ; ?> px-3 py-2 rounded-md text-sm font-medium">What's new</a>
                        <a href="/myMessage" class="<?= isUrl("/myMessage") ? $thisPage : $thatPage ; ?> px-3 py-2 rounded-md text-sm font-medium">My Message</a>
                        <a href="/createMessage" class="<?= isUrl("/createMessage") ? $thisPage : $thatPage ; ?> px-3 py-2 rounded-md text-sm font-medium">Create Message</a>

                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">


                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                            <button type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                            </button>
                        </div>

                        <!--
                          Dropdown menu, show/hide based on menu state.

                          Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                        -->
                        <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
<!--                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>-->

<!--                            <a href="/setting" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>-->
                            <?php
                            if (empty($_SESSION)) { ?>
                                <a href="/login" class="block px-4 py-2  text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Login</a>
                                <a href="/signup" class="block px-4 py-2  text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Sign up</a>
                            <?php } else { ?>
                                <a class="block px-4 py-2  text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0"><?= "Hi! " . $_SESSION["nickname"] ?></a>
                                <a href="/updateMember?memberID=<?= $_SESSION["memberID"]; ?>" class="block px-4 py-2  text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Account</a>
                                <a href="/logout" class="block px-4 py-2  text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Logout</a>
                                <?php
                                if (isset($_SESSION["ADMIN"])) { ?>
                                    <a href="/admin" class="block px-4 py-2  text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-0">Admin Area</a>
                            <?php }
                            }?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</nav>