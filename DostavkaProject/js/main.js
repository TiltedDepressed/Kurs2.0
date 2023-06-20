


changeQty();


function changeQty(){

    document.querySelectorAll('[data-quantityPlus],[data-quantityMinus]').forEach(item => {
        item.addEventListener('click', e => {
             e.preventDefault()

             let productContainer = item.closest('[data-productContainer]') || document

             let qtyEl =  productContainer.querySelector('[data-quantity]')

             if(qtyEl){
                let qty = +qtyEl.innerHTML || 1
                if(item.hasAttribute('data-quantityPlus')){
                    qty++;
                }else{
                     qty = qty <= 1 ? 1 : --qty;
                }

                qtyEl.innerHTML = qty

                let addToCard = productContainer.querySelector('data-addToCard')
                if(addToCard){
                    if(addToCard && addToCard.hasAttribute('data-toCardAdded')){
                        addToCard.dispatchEvent(new Event('click'))
                    }
                }
             }
        })
    })
}