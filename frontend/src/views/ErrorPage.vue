<template>
  <div class="error">
      <div class="num">404</div>
      <p>PAGE NOT FOUND :(</p>
  </div>
</template>

<script>
export default {
  name: "ErrorPage",
}
</script>

<style>
  .error{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 14%;
  }
  .num{
    font-size: 58px;
    font-weight: bold;
  }
  p{
    font-size: 20px;
  }
</style>