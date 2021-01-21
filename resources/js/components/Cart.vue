<template>
  <div>
    <div>
      <div class="mt-2r" v-for="(student, index) in studentsData" :key="index">
        <h3>{{ student.name }}</h3>
        <div class="overflow-auto">
        <div v-for="(item, i) in student.enroll_items" :key="i" class="row border-bottom py-3 min-table">
          <div class="col-8"><p>{{ item.type }} <span class="small">( {{ item.start_date }} - {{ item.end_date }} )</span> </p></div>
          <div class="col-2 text-right price"><p>${{ item.amount }}</p></div>
          <div class="col-2 text-right" @click="remove(item.id, index, i, item.amount)" > <a href="javascript:void(0)"> Remove </a></div>
        </div>
        </div>
      </div>
    </div>
    <div class="cart-total row py-2">
      <div class="col-8 text-right"><p>Total</p></div>
      <div class="col-2 text-right price"><p> ${{ total }}</p></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "GetCart",
  data() {
    return {
      total:0,
      studentsData: this.students
    };
  },
  props: {
    students: {
      required: true,
    },
  },
  methods: {
    remove(id, studentIndex, enrollIndex, amount){
      axios
        .delete(route("delete.cart",id))
        .then(
          (response) => {
            const resp = response.data;
            if(resp.status == 'success') {
              this.total -= amount;
              this.studentsData[studentIndex]['enroll_items'].splice(enrollIndex, 1);
              if(this.studentsData[studentIndex]['enroll_items'].length == 0){
                delete this.studentsData[studentIndex];
              }
            }else{
              alert(resp.message);
            }
          }
        )
        .catch((error) => console.log(error));
    }
  },
  mounted(){
    let total = 0;
    for (const student in this.studentsData) {
      if (this.studentsData.hasOwnProperty(student)) {
        const el = this.studentsData[student];
      
        el.enroll_items.forEach(element => {
          total = total + (element['amount'] * 1);
        });
      }
    }
 
    this.total = total;
  }
};
</script>

