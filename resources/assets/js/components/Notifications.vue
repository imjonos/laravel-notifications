<template>
 <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fa fa-bell"></i>{{ messages.length}} 
      </a>
      <div class="dropdown-menu">
          <a v-for="massage in messages"  :key="massage.id"  class="dropdown-item" @click="setRead(massage.id, massage.links.self)">
              {{massage.attributes.text}} 
          </a>
      </div> 
  </li>    
</template>
<script>

export default {
  name: 'notifications',
  props : [
    'id'
  ],
  components: {

  },
  data: function() {
    return {
      messages: [],
    };
  },
  updated: function () {

  },
  mounted: function() {
      this.getData();
      Echo.private('App.User.' + this.id)
      .notification((notification) => {
        this.getData();
        console.log(notification.type);
        //Добавляем сюда уведомление и прочее что нужно
        alert(notification.type);
      });
  },
  methods: {
    getData: function(){
      axios.get("/users/"+this.id+"/notifications")
      .then((response) => {
        this.messages = response.data.data;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    setRead: function(messageId, link){
      axios.patch("/users/"+this.id+"/notifications/"+messageId)
      .then((response) => {
         document.location.href = link;
      })
      .catch(function (error) {
        console.log(error);
      });
    }

  },
};
</script>

<style lang="scss">
  @import './../../css/notifications.css';
</style>