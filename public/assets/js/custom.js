$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
// Class Active
let activeLink = document.querySelectorAll('.nav-link');
activeLink.forEach((element)=>{
  element.addEventListener('active',(e)=>{
    element.classList.toggle('tw-bg-prim-white');
  })
})

// Dropdown Sidebar
let dropdownMenu = document.querySelectorAll('.sidebar .has-submenu .sub-nav-link');

dropdownMenu.forEach(function(element){
  element.addEventListener('click',(e)=>{
    let submenu = element.nextElementSibling;

    submenu.classList.toggle("show");
    submenu.classList.toggle("collapse");
  })
})

// Datatable

$(document).ready(function () {
  $('#example').DataTable();
});

// Select 2
$(document).ready(function() {
  $('.select-2').prepend('<option selected=""></option>').select2({placeholder: "Pilih Data"});
  $('.select-user').prepend('<option selected=""></option>').select2({placeholder: "Pilih User"});
  $('.select-trans').prepend('<option selected=""></option>').select2({placeholder: "Pilih Barang"});
  $(".input-select2").select2({
    dropdownParent: $("#modalPop")
  });

  $(".kota").select2({
    dropdownParent: $("#suppliermodal")
  });
});

function addValueKasir(inputID){
  let value = document.getElementById(inputID);
  let intValue = parseInt(value.value);
  intValue += 1;

  value.value = intValue;

}

function atcButton(event) {
  let button = event;
  let item = button.parentElement;
  let namaProduk = item.querySelector('.nama-produk').innerText;
  let harga = item.querySelector('.harga-produk').innerText;
  let merk = item.querySelector('.merk-produk').innerText;
  let img = item.querySelector('.img-item').src;
  let pcs = item.querySelector('#jumlah-kasir').value;

  console.log(namaProduk,harga,merk,img,pcs);
  addtocartItem(namaProduk,harga,merk,img,pcs);
  updateHarga(harga,pcs);
}

function updateHarga(harga,pcs){
  let subtotal = document.querySelector('.subtotal span');
  let pajak = document.querySelector('.tax span');
  subtotal.innerText = parseInt(harga) * parseInt(pcs);
  pajak.innerText = parseInt(harga) * parseInt(pcs) + (parseInt(harga) * parseInt(pcs) * 11 / 100  );
}

function deleteCartItem(event){
  let button = event;
  let cartRow = button.parentNode.parentNode.parentNode;
  cartRow.parentNode.removeChild(cartRow); 

  
}

function addtocartItem(namaProduk,harga,merk,img,pcs){
  let cartRow = document.createElement('div');
  let cart = document.getElementsByClassName('cart')[0];
  let itemNames = document.getElementsByClassName('cart-nama');
  for (let i = 0 ; i < itemNames.length ; i++ ){
    if(itemNames[i].innerText = namaProduk){
      alert('Item Sudah Di Keranjang')
      return 
    }
  }
  cartRowContents = `<div class="item-cart">
  <div class="tw-grid tw-grid-cols-3 tw-items-center tw-justify-between">
      <div class="img-cart">
          <img src="${img}" alt="" width="80">
      </div>
      <div class="tw-col-span-2 tw-pl-[20px]">
          <h3 class="tw-text-[16px] tw-font-bold cart-nama">${namaProduk}</h3>
          <p class="tw-text-prim-red tw-font-bold tw-text-[14px] tw-m-0 tw-mt-1 cart-harga">Rp. ${harga}</p>
          <p class="tw-text-prim-black tw-text-[12px] tw-m-0 tw-mt-1 cart-merk">${merk}</p>
      </div>
  </div>
  <div class="deleteInput tw-mt-5 tw-grid tw-grid-cols-2 tw-justify-between tw-gap-5">
      <div class="input-group">
          <div class="input-group-prepend">
              <button type="button"  onclick="minValueKasir('jumlah-kasir')" class="min-btn w-outline-none tw-border-transparent tw-px-2 tw-bg-prim-red tw-text-prim-white">-</button>
          </div>
          <input type="text" class="form-control tw-w-4 tw-text-center" aria-label="Amount" id="jumlah-kasir" value="${pcs}" name="stok" disabled>
          <div class="input-group-prepend">
              <button type="button" onclick="${addValueKasir('jumlah-kasir')}" class="plus-btn tw-bg-prim-red tw-text-prim-white tw-outline-none tw-border-transparent
tw-px-2">+</button>
          </div>
      </div>
      <div>
          <button onclick="deleteCartItem(this)" class="tw-px-4 tw-py-1">
              <p class="tw-m-0">Delete</p>
          </button>
      </div>
  </div>
</div>
</div>`
  cartRow.innerHTML = cartRowContents;
  cart.append(cartRow);
}



function minValueKasir(inputID){
  let value = document.getElementById(inputID);
  let intValue = parseInt(value.value);
  if(intValue > 0){
    intValue -= 1;
  } else {
    intValue = 0;
  }

  value.value = intValue;
}

function addRow(tableID) {
  var table = document.getElementById(tableID);
  var rowCount = table.rows.length;
  var row = table.insertRow(rowCount);
  var colCount = table.rows[0].cells.length;
  for(var i=0; i<colCount; i++) {
      var newcell = row.insertCell(i);
      newcell.innerHTML = table.rows[0].cells[i].innerHTML;
      var child = newcell.children;
      for(var i2=0; i2<child.length; i2++) {
          var test = newcell.children[i2].tagName;
      }
  }
}

function deleteRow(btn, tableId) {
  var table = document.getElementById(tableId);
  var rowCount = table.rows.length;
  var row = btn.parentNode.parentNode;
  if(rowCount > 1){
    
    row.parentNode.removeChild(row);  
  }
 
}

$(function() {
  $(document).on('submit', '#trans_beli', function(e) {
     e.preventDefault();
     var $form = $(this);
    var serializedData = $form.serialize();
    var action = $(this).attr('action');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: action,
        data: serializedData,
        dataType: 'JSON',
        success: function(response) {
           if (response['data'] == "success") {
                swal.fire(
                    'Berhasil',
                    'Transaksi berhasil ditambahkan',
                    'success'
                );
                $( '#trans_beli' ).each(function(){
                  this.reset();
              });
           } else {
                swal.fire(
                    'Gagal',
                    'Lengkapi Form',
                    'warning'
                );
           }
       
        },
        error: function(xhr, status, error) {
          swal.fire(
            'Gagal',
            'Lengkapi Form',
            'warning'
        );
        }
    });
    return false;
})
});

