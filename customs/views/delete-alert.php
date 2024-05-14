<?php
$js = "
$('#w0 a.text-danger').click(function(event) {
    event.preventDefault();
    
    var url = $(this).attr('href');
    console.log(url);

    Swal.fire({
        title: 'Hapus Data',
        text: 'Apakah anda yakin ingin menghapus data?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, Hapus Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                success : function(data){
                    if (data.code == 200) {
                        var title = 'Sukses!';
                        var message = 'Data Berhasil Dihapus.';
                        var icon = 'success';
                    } else {
                        var title = 'Gagal!';
                        var message = 'Data Gagal Dihapus.';
                        var icon = 'error';
                    }
                    Swal.fire(
                        title,
                        message,
                        icon
                    ).then((result) => {
                        location.reload();
                    });
                }
            });
        }
    })
})
/* function deleteData(e){
    e.preventDefault();
    var url = $(this).attr('href');
    console.log(url);
    Swal.fire({
        title: 'Hapus Data',
        text: 'Apakah anda yakin ingin menghapus data?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, Hapus Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Sukses!',
                'Data Berhasil dihapus.',
                'success'
            )
        }
    })
} */
";

$this->registerJs(
    $js,
    $this::POS_END,
    'delete-handler'
);
?>