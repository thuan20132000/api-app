






    // delete Category
    $('.deleteCategory').on('click',function(){
        let $id = $(this).data('id');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'DELETE',
                url: 'category/' + $id,
                success:function($result){
                    toastr.options.showEasing = 'swing';
                    toastr.success('Delete Successful');

                    toastr.options.closeDuration = 5000;
                    setTimeout(() => {
                        location.reload();
                    }, 1500);

                }
            })
    });



    // update
    var idCategory;

    $('.editCategory').on('click',function(){
        idCategory = $(this).data('id');
        $('#editModal').modal("toggle");

        $.ajax({
            method: 'GET',
            url: 'category/' + idCategory,
            success:function($result){


                $('.name').val($result.data.name);
                $('.imgUrl').attr("src",$result.data.imageUrl);
                if($result.data.status === 1){
                    $('#status-1').attr('checked',true);
                }else{
                    $('#status-0').attr('checked',true);

                }

            }
        })

    });


    $('.updateCategory').on('click',function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let $status = $('input[name=status]:checked').val();
            let $name = $('.name').val();

            $.ajax({
                method: 'PUT',
                url: 'category/' + idCategory,
                data:{
                    'name':$name,
                    'status':$status,
                },
                success:function($result){
                    console.log($result);
                    toastr.options.showEasing = 'swing';
                    toastr.success('Update Successful');

                    toastr.options.closeDuration = 5000;
                    setTimeout(() => {
                        location.reload();
                    }, 1500);

                }
            })
    });








    // delete product
    $('.deleteProduct').on('click',function(){
        let $id = $(this).data('id');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: 'DELETE',
                url: 'product/' + $id,
                success:function($result){
                    console.log($result);
                    toastr.options.showEasing = 'swing';
                    toastr.success('Delete Successful');

                    toastr.options.closeDuration = 5000;
                    setTimeout(() => {
                        location.reload();
                    }, 1500);

                }
            })
    });



    // update
    var idProduct;

    $('.editProduct').on('click',function(){
        idProduct = $(this).data('id');
        $('#editModal').modal("toggle");


        $.ajax({
            method: 'GET',
            url: 'product/'+idProduct+'/edit',
            success:function($result){
                console.log($result);
                $('.name').val($result.data.name);
                $('.description').val($result.data.description);
                $('#img-upload').attr("src",$result.data.imageUrl);
                $('.description').val($result.data.detail);
                $('.price').val($result.data.price);
                $('.stock').val($result.data.stock);
                $('.discount').val($result.data.discount);
                $('.color').val($result.data.color);
                $('.size').val($result.data.size);
                if($result.data.status === 1){
                    $('#status-1').attr('checked',true);
                }else{
                    $('#status-0').attr('checked',true);

                }



            }
        })

    });



    var form = document.querySelector('#update_form');


    //

            let $status ;
            let $name;
            let $imgUrl;
            let $description ;
            let $price ;
            let $discount ;
            let $stock;
            let $color;
            let $size ;
            let $category ;

            $('.color').change(function(){
                $color = this.value;
            });
            $('.size').change(function(){
                $size = this.value;
            });






    $('#update_form').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $status = $('input[name=status]:checked').val();
         $name = $('.name').val();
        //  $imgUrl = $() ;
         $description = $('.description').val();
         $price = $('.price').val();
         $discount = $('.discount').val();
         $stock = $('.stock').val();
         $color = $('.color').val();
         $size = $('.size').val();
         $category = $('.category').val();

        $.ajax({
            method: 'PUT',
            url: 'product/' + idProduct,
            // cache:false,
            contentType: true,
            processData: false,
            data:{
                'name':$name,
                'status':$status,
                'description':$description,
                'price':$price,
                'discount':$discount,
                'stock':$stock,
                'color':$color,
                'size':$size,
                'fi':formData
            },
            // data:formData,
            success:function($result){
                console.log($result);
                // toastr.options.showEasing = 'swing';
                // toastr.success('Update Successful');

                // toastr.options.closeDuration = 5000;
                // setTimeout(() => {
                //     location.reload();
                // }, 1500);

            }
        });

    });




