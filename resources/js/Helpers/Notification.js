class Notification{

    success(){
        new Noty({
      type: 'success',
      layout: 'topRight',
      text: 'Successfully Done!',
      timeout: 1000,
         }).show();
    }


    alert(){
        new Noty({
      type: 'alert',
      layout: 'topRight',
      text: 'Are you Sure?',
      timeout: 1000,
         }).show();
    }



    error(){
        new Noty({
      type: 'alert',
      layout: 'topRight',
      text: 'Something Went Wrong ! ',
      timeout: 1000,
         }).show();
    }


   warning(msg){
        new Noty({
      type: 'warning',
      layout: 'topRight',
      text: msg ?? 'Opps Wrong ',
      timeout: 1000,
         }).show();
    }



    image_validation(){
      new Noty({
      type: 'error',
      layout: 'topRight',
      text: 'Upload Image less then 1MB ',
      timeout: 1000,
         }).show();
    }



      addedToCart(){
      new Noty({
      type: 'success',
      layout: 'topRight',
      text: 'Successfully Add to Cart!',
      timeout: 1000,
         }).show();
    }


     cart_delete(){
      new Noty({
      type: 'success',
      layout: 'topRight',
      text: 'Successfully Deleted!',
      timeout: 1000,
         }).show();
    }

    itemExist(item){
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: `${item} is already  selected`,
            timeout: 1000,
        }).show();
    }

    stockOutForProduct(name){
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: `Stock is out for ${name} product.`,
            timeout: 1000,
        }).show();
    }



  }

  export default Notification = new Notification()
