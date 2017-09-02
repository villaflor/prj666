<!--
Blue template - Categories section, 
retrieves and provides of categories of a client company, formatted for BLUE template
each category entry links to a GoodDetail page that will display goods in that category

HTML/CSS/PHP created by Olga
-->
<div class="categories">
	<ul>
        <?php


        mysqli_data_seek($allcategory, 0);
        while ($row = mysqli_fetch_assoc($allcategory)){
        ?>
		<li><a href="GoodList.php?cid=<?php echo "$row[category_id]";?>"><?php echo "$row[category_name]";  ?></a></li>
        <?php
        }
        ?>
	</ul>
</div>