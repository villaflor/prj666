<!doctype html>
<html lang="en">
<head>
    <?php include("metadata.php") ?>
    <title>Green Template</title>
</head>

<body style="background-color: seagreen">
<header class="mb-5 mt-3" style="height: 20vh; align-content: center;">
        <?php include("header.inc") ?>
    </header>
    <div class="container mb-5">
        <nav class="nav nav-pills nav-fill">
            <a class="nav-item nav-link text-white" href="index.php">Home</a>
            <a class="nav-item nav-link text-white" href="products.php">Products</a>
            <a class="nav-item nav-link active" href="cart.php">Cart</a>
            <a class="nav-item nav-link text-white" href="about-us.php">About us</a>
            <?php
                $alldata = $page->getAll();
                while ($row = mysqli_fetch_assoc($alldata)) {
                  echo '<a class="nav-item nav-link text-white" href="page.php?page='.$row['id'].'">'.$row['page_name'].'</a>';
                }
            ?>
        </nav>
    </div>

    <table width="250" height="50" border="0" style="margin:auto;">
        <tbody>
        <tr>
            <td style="font-size: 30px; font-weight: bold;">Shopping Cart</td>
            <td><img src="images/28468-200.png" width="35" height="35" alt="cart"/></td>
        </tr>
        </tbody>
    </table>

    <div class="verticalspacer" data-offset-top="0" data-content-above-spacer="273" data-content-below-spacer="727" style="margin-top: 100px;">
        <table width="80%" style="margin:auto;" >
            <tbody>
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%;"><p style="font-size: 25px;">Quantity</p></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%;"></td>
            </tr>
            <tr>
                <td style="width: 20%;padding-top: 50px"><img src="images/cow.jpg" alt="" height="150" width="150"></td>
                <td style="width: 20%;"><p style="font-size: 25px;">Product's name</p></td>
                <td style="width: 20%;"><select style="width: 25%;">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>


                    </select></td>
                <td style="width: 20%;"><p style="font-size: 25px;">Product's price</p></td>
                <td style="width: 20%;"><a href="" style="font-size: 25px; color: crimson;">Remove</a></td>
            </tr>

            <tr>
                <td style="width: 20%; padding-top: 100px"><img src="images/cow.jpg" alt="" height="150" width="150"></td>
                <td style="width: 20%;"><p style="font-size: 25px;">Product's name</p></td>
                <td style="width: 20%;"><select style="width: 25%;">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>


                    </select></td>
                <td style="width: 20%;"><p style="font-size: 25px;">Product's price</p></td>
                <td style="width: 20%;"><a href="" style="font-size: 25px;color: crimson;">Remove</a></td>
            </tr>
            <tr >
                <td style="width: 20%; padding-top: 100px"></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%;">---------------------------------</td>
                <td style="width: 20%;"></td>
            </tr>
            <tr >
                <td style="width: 20%; padding-top: 100px"></td>
                <td style="width: 20%;"></td>
                <td style="width: 20%;"><p style="font-size: 25px;">Total of items</p></td>
                <td style="width: 20%;"><p style="font-size: 25px;">$Total price</p></td>
                <td style="width: 20%;"></td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="bg-primary" style="width: 127px; height: 50px; border-radius: 10px; margin-left: 58%; margin-top: 50px; margin-bottom: 61px; font-size: 20px;">To checkout</button>
    </div>

    <?php include_once("footer.php");?>
</body>
</html>
