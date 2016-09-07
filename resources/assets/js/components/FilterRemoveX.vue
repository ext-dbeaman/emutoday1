module.exports =(function (value) {
  return (value[0] == 'x') ? value.substr(1) : value;
  <!-- return value.split('').reverse().join('')-->
})
