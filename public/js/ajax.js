






    // delete
    $('.delete').on('click',function(){
        let $id = $(this).data('id');


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "DELETE",
                url: 'category/' + $id,
                success:function($result){
                    console.log($result);

                }
            })
    });


