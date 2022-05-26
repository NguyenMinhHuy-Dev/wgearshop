<?php
    include("../.././config/config.php"); 
?>

<div class="return">
    <span onclick="comeback()"><i class="fa-solid fa-arrow-left-long"></i> Return</span>
</div>

<div class="add-product-form">
    <form action="modules/managePromotion/handle.php" enctype="multipart/form-data" method='POST'>
        <table class="products-table">
            <thead>
                <tr style="height: 50px"> 
                    <th rowspan='1' colspan='2' style='width:300px; min-width: 200px'>NEW PROMOTION</th> 
                </tr>
            </thead>
            <tbody id="table-body"> 
                <tr>
                    <td style='width:200px'>Name</td>
                    <td style='width:200px'><input type="text" name="tenkhuyenmai" id="tenkhuyenmai" class="input" required></td> 
                </tr>    
                <tr>
                    <td style='width:200px'>Image</td>
                    <td style='width:200px'><input type="file" name="hinhanh" id="hinhanh" required></td> 
                </tr>    
                <tr>
                    <td colspan='2' style='width:200px'><input type="submit" name="themkhuyenmai" class="input btn btn--pri" value="ADD PRODUCT"></td>
                </tr> 
            </tbody>
        </table>
    </form>
</div>