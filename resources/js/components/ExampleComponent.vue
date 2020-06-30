<template>
  <h1>just Fun</h1>
</template>

<script>
export default {
	data() {
        return {
            
        };
    },
  mounted() {
    // Echo.channel("notification").listen("SendNotificationUser", e => {
    //   alert(e);
    //   console.log("event", e);
    // });

    Echo.private('noti').listen("SendNotificationUser", (e) => {
        console.log(e);
        console.log('herse');

    });
  } 
};
</script>
