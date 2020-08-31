<template>
  <div>
    <h2>List of Products</h2>
        <div v-for="buyer in displayedPosts ">
          <div class="card bg-primary text-white">
            <div class="card-body">
            <div>Имя пользователя:{{buyer.name}}</div><hr>
              <div v-for="product in products">
                <div v-if="product.buyer.id === buyer.id">
                  <div>Модель: {{product.product_type}}</div>
                  <div>Количество: {{product.quantity}}</div>
                  <form action="/api/updateproduct" method="POST">
                  <select name="status" id="status">
                    <option value="" disabled selected>{{ product.status }}</option>
                    <option value="Новый">Новый</option>
                    <option value="Отправлен">Отправлен</option>
                    <option value="Отменен">Отменен</option>
                  </select>
                  <input name="nameId" type="hidden" :value="product.id" >
                  <input  type="submit" value="Создать">
                  </form>
                </div>
              </div>
            </div>
          </div>
          <br><br><br>
        </div>
    <div class="clearfix btn-group col-md-2 offset-md-5">
      <button type="button" class="btn btn-sm btn-outline-secondary" v-if="page !== 1" @click="page--"> << </button>
      <button type="button" class="btn btn-sm btn-outline-secondary" v-for="pageNumber in pages.slice(page-1, page+5)" @click="page = pageNumber"> {{pageNumber}} </button>
      <button type="button" @click="page++" v-if="page < pages.length" class="btn btn-sm btn-outline-secondary"> >> </button>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  data: function () {
    return {
      products: [],
      buyers: [],
      page: 1,
      perPage: 9,
      pages: [],
      status: ''
    };
  },
  methods: {
    showProduct() {
      axios
          .get('api/showproduct')
          .then(response => {
            this.products = response.data
            console.log(response.data)
            console.log(this.products)
          })
      axios
          .get('api/showbuyer')
          .then(response => {
            this.buyers = response.data
            console.log(response.data)
            console.log(this.buyers)
          })
    },
    setPages () {
      let numberOfPages = Math.ceil(this.buyers.length / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate (buyers) {
      let page = this.page;
      let perPage = this.perPage;
      let from = (page * perPage) - perPage;
      let to = (page * perPage);
      return  buyers.slice(from, to);
    }
  },
  created() {
    this.showProduct();
  },
  watch: {
    buyers () {
      this.setPages();
    }
  },
  computed: {
    displayedPosts () {
      return this.paginate(this.buyers);
    }
  },

}
</script>
