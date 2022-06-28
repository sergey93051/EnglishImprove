import Vuex from 'vuex'
import index from "./modules/index"
import elasicProduct from "./modules/elasicProduct"
import validation from "./modules/validation"
import products from  "./modules/product"
import cart from "./modules/cart"
import auth from "./modules/auth"
import register  from './modules/register'
import csrf from './modules/csrf'


export default new Vuex.Store({

     modules:{       
        index,
        elasicProduct,
        validation,
        products,
        cart,
        auth,
        register,
        csrf
     }
})