<?php
include('header.php');
?>

<!-- Order Form Area Start

====================================================== -->

<?php
//get category list
$categories=$obj->getCategoryList();
?>

<form action="place-order.php" method="post" id="order_frm">

    <section class="order-form">

        <div class="container text-center">

            <h2>Start Your Order</h2>

            <p class="medium-txt">You can use below form to get an estimate of your project.</p>

            <!-- Order Buttons Start -->

            <div class="order-btns clearfix">
                <?php
                //Listing all categories
                if(!empty($categories))

                {

                    foreach($categories as $category)

                    {

                        ?>

                        <div class="col-md-3">
                            <a class="order-opt-link" id="<?php echo $category['idCategory']?>">

                     <span class="icon">


                     <?php
                     if($category['is_image']==1){
                         ?>

                         <?php
                         $catImage=$siteLink.'/public/uploads/category/'.$category['catImage'];
                         if($category['catImage']!=""){
                             //if(file_exists($catImage)){?>
                             <img src="<?php echo $siteLink;?>/timthumb.php?src=<?php echo $siteLink;?>/public/uploads/category/<?php echo $category['catImage']?>&w=50&amp;h=50&amp;zc=1">
                             <?php //}
                         }?>

                     <?php }
                     if($category['is_image']==2){?>
                         <i class="<?php echo $category['catImage'];?>"></i>
                     <?php } ?>

                     </span>

                                <span id="order-con-id"><?php echo $category['catName']?></span>

                            </a>

                        </div>

                        <?php

                    }

                }

                ?>

            </div>

            <!-- Order Buttons End -->



            <!-- Order Form Categories Start -->

            <div class="order-catogories clearfix">



                <!-- Order section Start -->

                <div class="col-md-8 clearfix">

                    <div class="row">

                        <?php
                        //get product list
                        $products=$obj->getproductList();
                        ?>

                        <!-- Package1 Start -->

                        <?php
                        //List all products and show only first category's product on first load
                        if(!empty($products))

                        {

                            foreach($categories as $category)

                            {

                                $groupproducts=$obj->getproductByCategory($category['idCategory']);

                                if(!empty($groupproducts))

                                {
                                    //show 4 products in a row
                                    if(count($groupproducts)>2)
                                    {
                                        ?>
                                        <div id="cms-main-category" class="col-md-12 cms-category">
                                            <div class="row">
                                                <?php
                                                $i=0;
                                                foreach($groupproducts as $product)
                                                {
                                                    ?>

                                                    <div class="col-md-3 pdcts" id="<?php echo $product['idproduct'];?>" data-catid="<?php echo $product['idCategory'];?>">
                                                        <div class="cms-cont pdcteach <?php if($i==0){?>active<?php } ?>"  data-cost1="<?php echo $product['productPrice'];?>" id="normal-pk<?php echo $product['idproduct'];?>" data-productname="<?php echo $product['productName'];?>">
                                                            <?php
                                                            if($product['is_image']==1){
                                                                ?>

                                                                <?php
                                                                $productImage=$siteLink.'/public/uploads/products/'.$product['productImage'];
                                                                if($product['productImage']!=""){?>
                                                                    <img src="timthumb.php?src=public/uploads/products/<?php echo $product['productImage']?>&w=80&amp;h=80&amp;zc=1">
                                                                    <?php
                                                                }?>

                                                            <?php }
                                                            if($product['is_image']==2){?>
                                                                <i class="<?php echo $product['productImage'];?>"></i>
                                                            <?php } ?>

                                                            <h5><?php echo $product['productName'];?></h5>
                                                            <?php if($show_price==1){?>
                                                                <p id="price-pk<?php echo $product['idproduct'];?>" data-price="<?php echo $product['productPrice'];?>"><span><?php echo $currency?></span><?php echo number_format($product['productPrice'],2);?></p>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                    <?php

                                                    $i++;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    else//show 2 products in a row
                                    {
                                        $i=0;
                                        foreach($groupproducts as $product)
                                        {

                                            ?>

                                            <div class="col-md-6 pdcts" id="<?php echo $product['idproduct'];?>" data-catid="<?php echo $product['idCategory'];?>">

                                                <div class="html5-web" id="pdct-outer">

                                                    <div class="normal-pk pdcteach <?php if($i==0){?>active<?php } ?>" id="normal-pk<?php echo $product['idproduct'];?>" data-cost1="<?php echo $product['productPrice'];?>" data-productname="<?php echo $product['productName'];?>">
                                                        <?php
                                                        if($product['is_image']==1){
                                                            ?>

                                                            <?php
                                                            $productImage=$siteLink.'/public/uploads/products/'.$product['productImage'];
                                                            if($product['productImage']!=""){?>
                                                                <img src="<?php echo $siteLink;?>/timthumb.php?src=<?php echo $siteLink;?>/public/uploads/products/<?php echo $product['productImage']?>&w=50&amp;h=50&amp;zc=1">
                                                                <?php
                                                            }?>

                                                        <?php }
                                                        if($product['is_image']==2){?>
                                                            <i class="<?php echo $product['productImage'];?>"></i>
                                                        <?php } ?>
                                                        <h3><?php echo $product['productName'];?></h3>

                                                        <?php if($show_price==1){?>
                                                            <div class="price" id="price-pk<?php echo $product['idproduct'];?>" data-price="<?php echo $product['productPrice'];?>"><span><?php echo $currency?></span><?php echo number_format($product['productPrice'],2);?></div>
                                                        <?php } ?>

                                                        <p><?php echo $product['productDesc'];?></p>

                                                    </div>

                                                </div>

                                            </div>

                                            <?php

                                            $i++;
                                        }
                                    }

                                }

                            }

                        }



                        ?>

                        <input type="hidden" name="product" id="product" value="">
                        <input type="hidden" name="show_price" id="show_price" value="<?php echo $show_price;?>">



                        <!-- CMS Services End -->


                        <div class="col-md-12">
                            <?php
                            //List all options and show only first product's options
                            $productoptions=$obj->getProductOptions();

                            ?>
                            <!-- Additional Options Start -->
                            <?php

                            if(!empty($productoptions))

                            {

                                ?>
                                <div class="addi-opts" id="add_options">

                                    <ul class="list-opt clearfix"><li><span>Advanced Options</span></li></ul>





                                    <ul class="list-opt clearfix">

                                        <?php

                                        foreach($productoptions as $option)

                                        {

                                            $optiondetails=$obj->getProductOptionsById($option['idOption']);

                                            ?>

                                            <li class="opns" data-pdctid="<?php echo $option['idProduct']?>">

                                                <input type="checkbox" id="dyn_menus_<?php echo $option['idOption'];?>" data-pdct="<?php echo $option['idProduct']?>" value="<?php echo $optiondetails['optionname'];?> <span>[<?php echo $currency.$optiondetails['optionPrice'];?>]</span>" name="html_options[]" class="check-opt" data="<?php echo $optiondetails['optionname'];?>" data-cost2="<?php echo number_format($optiondetails['optionPrice'],2);?>">
                                                <?php echo $optiondetails['optionname'];?>
                                                <?php if($show_price==1){?>
                                                    <span>[<?php echo $currency.$optiondetails['optionPrice'];?>]</span>
                                                <?php } ?>
                                            </li>

                                            <?php

                                        }

                                        ?>

                                    </ul>





                                </div>
                                <?php

                            }

                            ?>
                            <!-- Additional Options End -->



                            <!-- Form Start -->

                            <div class="submit-opts-form clearfix">

                                <div class="controls" id="error_order" style="color:red;"></div>

                                <div class="clearfix">

                                    <input type="text" name="currency" id="currency" style="display:none;" value="<?php echo $currency?>"/>

                                    <input type="text" name="customer_choice" style="display: none;"/>

                                    <input type="text" name="customer_sub_choice" style="display: none;"/>

                                    <input type="text" name="type_cost" style="display: none;"/>

                                    <input type="text" name="actual_amt" style="display:none;"/>

                                    <input type="text" name="reduction" style="display:none;" value="0"/>

                                    <input type="text" name="order_total_amt" style="display: none;"/>

                                    <input type="text" name="innerpage_cost" style="display: none;"/>

                                    <input type="text" placeholder="Your Name *"  name="customer_name" class="first-field">

                                    <input type="text" placeholder="Your Email *" name="customer_email" class="second-field">

                                    <input type="text" placeholder="Your Phone" name="customer_contact"  class="third-field">

                                    <textarea cols="10" rows="5" name="customer_message" placeholder="Description *" class="forth-field"></textarea>
                                    <input type="hidden" id="no_prod" name="no_prod" value="0">
                                </div>

                                <!-- Order Concept Area Start -->

                                <div class="orderbtn-area" id="order_concept_area">

                                    <?php echo $bottom_content;?>
                                    <div class="order-btn-cont" id="order_btn_2"><a href="#" class="button" id="order_btn_id2">Order Now !</a></div>
                                </div>

                                <!-- Order Concept Area End -->

                            </div>

                            <!-- Form End -->

                        </div>

                    </div>

                </div>

                <!-- Order Section End -->



                <!-- Order Summary Start -->

                <div class="col-md-4 clearfix" id="order_summary_box">

                    <div class="summary-box">

                        <?php if($show_price==1){?>
                            <div class="heading-total">Order Summary : <span class="color-txt" id="order_total"><span><?php echo $currency?></span>0</span></div>
                        <?php }?>

                        <!-- Package Features Start -->

                        <div class="summary-basic-pack" id="summary-pack">

                            <?php

                            if(!empty($categories))

                            {

                                foreach($categories as $category)

                                {

                                    ?>
                                    <div id="catdesc<?php echo $category['idCategory']?>" class="catdesc">
                                        <?php echo $category['catDescription']?>
                                    </div>
                                    <?php

                                }

                            }

                            ?>


                        </div>




                        <?php

                        if(!empty($products))
                        ?>
                        <div class="summary-basic-pack" id="product-summary-pack">
                            <?php
                            {

                            foreach($products as $product)

                            {

                                ?>
                                <div id="proddesc<?php echo $product['idproduct']?>" class="proddesc">
                                    <?php echo $product['productDesc']?>
                                </div>
                                <?php

                            }
                            ?>
                        </div>
                        <?php
                        }

                        ?>




                        <!-- Package Features End -->

                        <!-- Innerpage count section Start -->

                        <div class="pages-area-cal">

                            <ul class="page-ul">

                                <li>Pages</li>

                                <li><input type="text" class="pages-txtbx" name="product_quantity" id="product_quantity" placeholder="1" value="1"></li>

                            </ul>

                        </div>

                        <!-- Innerpage count section End -->

                        <!-- Extra option selected section Start -->

                        <div class="summary-basic-pack">

                            <h5>Extra Options</h5>

                            <ul class="pack-add" id="pack-add">

                                <li id="nothing">No Option Selected</li>

                            </ul>

                        </div>

                        <!-- Extra option selected section End -->

                        <!-- Discount coupon section Start -->
                        <?php if($show_price==1){?>

                            <div class="coupon-box">

                                <h5><span><i class="fa fa-gift"></i></span> Have a Discount Coupon ?</h5>

                                <input type="text" name="coupon_text" id="coupon_text" class="coupon-txtbx" placeholder="Enter Code">

                                <a href="javascript:void(0);" id="discnt_btn_id">Apply !</a>

                                <p id="dis_price"></p>

                            </div>
                        <?php } ?>
                        <!-- Discount coupon section End -->

                        <!-- Main order button area Start -->

                        <div class="orderbtn-area">

                            <?php echo $bottom_content;?>

                            <div class="order-btn-cont"><a href="#" class="button" id="order_btn_id">Order Now !</a></div>

                        </div>

                        <!-- Main order button area end -->

                    </div>



                    <!-- Order Summary End -->



                </div>

                <!-- Order Form Categories End -->

            </div>

    </section>

</form>

<!-- =================================================

Order Content Area End -->





<!-- Footer Area Start

====================================================== -->

<footer class="footer-area text-center">

    <a href="index.html"><img src="img/f-logo.png" alt=""></a>

    <p>&copy;2018 <a href="http://www.pvaluewriters.com/" target="_blank">PValueWriters</a> All rights reserved.</p>

</footer>

<!-- =================================================

Footer Area End -->



<!-- JavaScript Files -->

<script type="text/javascript" src="js/jquery.js"></script><!--   jquery -->

<script type="text/javascript" src="js/bootstrap.js"></script><!-- Bootstrap js -->

<script type="text/javascript" src="js/core.js"></script><!-- Core js -->

<script type="text/javascript" src="js/orderform.js"></script><!-- Form js -->

</body>

</html>

