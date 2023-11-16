<!-- De header-sectie bevat het logo, navigatiemenu en gebruikersinformatie. -->
<header class="header">
    <div class="flex">
         <!-- Het logo wordt weergegeven als een link naar de homepagina. -->
        <a href="home.php" class="logo"><img src="img/ddd3.png"></a>
        <!-- Het navigatiemenu bevat links naar verschillende pagina's. -->
        <nav class="navbar">
            <a href="home.php">home</a>
            <a href="view_products.php">products</a>
            <a href="order.php">orders</a>
            <a href="about.php">about us</a>
            <a href="contact.php">contact us</a>
        </nav>
         <!-- De iconen-sectie bevat symbolen voor gebruikersinteractie, zoals het gebruikersmenu, wishlist en winkelwagen. -->
        <div class="icons">
            <i class="bx bxs-user" id="user-btn"></i>
             <!-- Als de gebruiker is ingelogd, worden het aantal items in de wishlist en winkelwagen weergegeven. -->
            <?php 
                if (isset($_SESSION['user_id'])) {
                    $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
                    $count_wishlist_items->execute([$_SESSION['user_id']]);
                    $total_wishlist_items = $count_wishlist_items->rowCount();
            ?>
            <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup><?=$total_wishlist_items ?></sup></a>
            <?php 
                $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $count_cart_items->execute([$_SESSION['user_id']]);
                $total_cart_items = $count_cart_items->rowCount();
            ?>
            <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup><?=$total_cart_items ?></sup></a>
             <!-- Als de gebruiker niet is ingelogd, wordt '0' weergegeven voor zowel wishlist als winkelwagen. -->
            <?php } else { ?>
            <a href="wishlist.php" class="cart-btn"><i class="bx bx-heart"></i><sup>0</sup></a>
            <a href="cart.php" class="cart-btn"><i class="bx bx-cart-download"></i><sup>0</sup></a>
            <?php } ?>
              <!-- Een menu-icoon voor mobiele weergave. -->
            <i class='bx bx-list-plus' id="menu-btn" style="font-size: 2rem;"></i>
        </div>
        <!-- Het gebruikersvak toont gebruikersinformatie en uitlogoptie indien ingelogd; anders, inlog- en registratielinks. -->
        <div class="user-box">
            <?php if (isset($_SESSION['user_id'])) { ?>
                <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>Email : <span><?php echo $_SESSION['user_email']; ?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class="logout-btn">Log out</button>
                </form>
            <?php } else { ?>
                <a href="login.php" class="btn" style="color: #000;">Login</a>
                <a href="register.php" class="btn" style="color: #000;">Register</a>
            <?php } ?>
        </div>
    </div>
</header>
