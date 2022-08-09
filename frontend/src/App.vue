<template>
  <v-app>
    <v-form @submit.prevent="sendMail">
      <h1><strong>Broadcast Mail</strong></h1>
      <v-radio-group  v-model="option">
        <v-radio  label="Expired Projects" value="Exp"></v-radio>
        <v-radio  label="In Progress Projects" value="Inp"></v-radio>
      </v-radio-group>
      <v-text-field
        required
        label="Subject Line"
        v-model="subject"
      ></v-text-field>
      <v-textarea
        required
        label="Content"
        v-model="content"
        rows="15"
      ></v-textarea>
      <input type="submit" class="sub" name="Send Mail" />
    </v-form>
  </v-app>
</template>

<script>
import axios from "axios";
export default {
  name: "App",

  components: {},

  data() {
    return{
    option: "",
    subject: "",
    content: "",
    };
  },
  methods: {
    sendMail() {
      if(!this.option )
      {
        alert("U should select Expired or In progress reports")
      }
      else if(!this.subject)
      {
        alert("U should type subject line")
      }
      else if(!this.content){
        alert("U should type conent of the E-mail")
      }
      else{
      console.log("E-mail broadcasted successfully");
      axios.post("http://localhost:8080/api/SendEmail", {
        option: this.option,
        subject: this.subject,
        content: this.content,
      });}
    },
  },
};
</script>
<style>
.v-form {
  width: 700px;
  height: fit-content;
  margin: 30px auto;
  background: beige;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}

.v-text-field {
  display: inline;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}

h1 {
  color: #35605a;
  text-align: center;
}

.sub {
  border: 1px solid;
  border-color: #35605a;
  border-radius: 30px;
  text-align: center;
  width: 80px;
}
</style>