<template>
  <div>
    <div>
      <div class="mt-2r" v-for="(student, index) in students" :key="index">
        <h3>{{ student.name }}</h3>
        <div v-for="(item, i) in student.enroll_items" :key="i" class="row border-bottom py-3">
          <div class="col-sm-6"><p>{{ item.type }} <span class="small">( {{ item.start_date }} - {{ item.end_date }} )</span> </p></div>
          <div class="col-sm-2 text-right price"><p>${{ item.amount }}</p></div>
          <div class="col-sm-2 text-right" @click="remove(item.id)"> <a href="javascript:void(0)"> Remove </a></div>
        </div>
      </div>
    </div>
    <div class="cart-total row py-2">
      <div class="col-sm-6"><p>Total</p></div>
      <div class="col-sm-2 text-right price"><p> ${{ total }}</p></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "GetCart",
  data() {
    return {
      total:0
    };
  },
  props: {
    students: {
      required: true,
    },
  },
  methods: {
    remove(id){
      console.log(id);
    }
  },
  mounted(){
    let total = 0;
    for (const student in this.students) {
      if (this.students.hasOwnProperty(student)) {
        const el = this.students[student];
      
        el.enroll_items.forEach(element => {
          total = total + (element['amount'] * 1);
        });
      }
    }
 
    this.total = total;
  }
};
</script>

