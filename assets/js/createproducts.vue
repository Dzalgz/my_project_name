<template>
  <div>
    <h2>Add product</h2>
   <form @submit.prevent="createBuyer">
      <div :errors="validationErrors" v-if="validationErrors"></div>
      <label for="town">Город</label>
      <input id="town" v-model="town" type="text" pattern="^([а-яА-Я]+(?:. |-| |'))*[а-яА-Я]*$" title="Формат: только русские буквы, пробелы и дефисы" placeholder="Ваш город" required><br>
      <label for="fio">ФИО</label>
      <input id="fio"  v-model="name" type="text" pattern="^([а-яА-Я]+(?:. |-| |'))*[а-яА-Я]*$" title="Формат: только русские буквы, пробелы и дефисы" placeholder="Ваше имя" required><br>
      <label for="postcode">Индекс</label>
      <input id="postcode"  v-model="postcode" type="text" pattern="[0-9]{6}" placeholder="Ваше индекс" title="Формат: 6 цифр" required><br>
      <label for="address">Адрес (улица, дом. квартира)</label>
      <input id="address" v-model="address" type="text" placeholder="Ваш адрес" title="Формат: не менее 10 символов и не более 50" minlength="10" maxlength="50" required><br>
      <label for="phone_number">Номер телефона</label>
      <input id="phone_number" v-model="phone_number" type="text" pattern="[1-9]{10}" title="Формат: (999) 999 99 99" placeholder="(___)-___-__-__" maxlength="10" value="+7" required><br>
      <label for="email">E-mail</label>
      <input id="email" v-model="email" type="email" title="Формат: e-mail должен содержать @ и точку" placeholder="email" required><br>
      <label for="product_type">Модель товара</label>
      <select id="product_type" name="Product_type" v-model="product_type" type="text" required>
        <option value="iphon 11">iphon 11</option>
        <option value="iphon 11 pro">iphon 11 pro</option>
        <option value="samsung galaxy s20">samsung galaxy s20</option>
        <option value="samsung galaxy s20+">samsung galaxy s20+</option>
        <option value="samsung galaxy s20 ultra">samsung galaxy s20 ultra</option>
      </select>
     <br>
      <label for="quantity">Количество товара</label>
      <input id="quantity" v-model="quantity" type="text" title="Формат: введите количество до 9" placeholder="Колво" required><br>
      <input type="submit" value="Создать заказ">
    </form>
  </div>
</template>
<script>
import axios from 'axios'
export default {
 data: function(){
    return {
      name: '',
      address: '',
      postcode: '',
      town: '',
      email: '',
      phone_number: '',
      product_type: '',
      quantity: '',
      validationErrors: ''
    };
  },
  methods: {
    createBuyer(){
      var request = {
        name: this.name,
        postcode: this.postcode,
        address: this.address,
        town: this.town,
        email: this.email,
        phone_number: this.phone_number,
        product_type: this.product_type,
        quantity: this.quantity
      };
      axios.post('/api/createbuyer', request)
          .then(response => {
                console.log(response);
                this.$router.push('/show_products')
              })
    }
  },
}
</script>
<!--pattern="[0-9]"-->