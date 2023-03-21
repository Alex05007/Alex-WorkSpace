<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alex Reserve</title>
<link rel="icon" href="../logo/Reserve.png" type="image/x-icon">
<link href='https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css' rel='stylesheet' type='text/css'>
  <link href='//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css' rel='stylesheet' type='text/css'>
  <link href='//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.8/css/bootstrap-switch.css' rel='stylesheet' type='text/css'>
  <link href='https://davidstutz.github.io/bootstrap-multiselect/css/bootstrap-multiselect.css' rel='stylesheet' type='text/css'>
</head>

<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}
.input-data{
  height: 40px;
  width: 100%;
  position: relative;
}
.input-data textarea{
  height: 100%;
  width: 500px;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid silver;
}
.input-data textarea:focus ~ label,
.input-data textarea:valid ~ label{
  transform: translateY(-20px);
  font-size: 15px;
  color: #06F;
}
.input-data label{
  position: absolute;
  bottom: 10px;
  left: 0;
  color: grey;
  pointer-events: none;
  transition: all 0.3s ease;
}
.input-data textarea:focus ~ .underline:before,
.input-data textarea:valid ~ .underline:before{
  transform: scaleX(1);
}
body {
	padding:100px;
	background-color:transparent;
}

.input-data .big{
  height: 100%;
  width: 500px;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid silver;
}
.input-data .big:focus ~ label,
.input-data .big:valid ~ label{
  transform: translateY(-20px);
  font-size: 15px;
  color: #06F;
}
.input-data .big:focus ~ .underline:before,
.input-data .big:valid ~ .underline:before{
  transform: scaleX(1);
}
.input-data .underline{
  position: absolute;
  height: 2px;
  width: 100%;
  bottom: 0px;
}
.input-data .underline:before{
  position:absolute;
  content: "";
  height: 100%;
  width: 500px;
  background: #06F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}

.input-data .small{
  height: 100%;
  width: 90px;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid silver;
}
.input-data .small:focus ~ label,
.input-data .small:valid ~ label{
  transform: translateY(-20px);
  font-size: 15px;
  color: #06F;
}
.input-data .small:focus ~ .underline:before,
.input-data .small:valid ~ .underline:before{
  transform: scaleX(1);
}
.input-data .underline2{
  position: absolute;
  height: 2px;
  width: 100%;
  bottom: 0px;
}
.input-data .underline2:before{
  position:absolute;
  content: "";
  height: 100%;
  width: 90px;
  background: #06F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}

.input-data .medium{
  height: 100%;
  width: 120px;
  border: none;
  font-size: 17px;
  border-bottom: 2px solid silver;
}
.input-data .medium:focus ~ label,
.input-data .medium:valid ~ label{
  transform: translateY(-20px);
  font-size: 15px;
  color: #06F;
}
.input-data .medium:focus ~ .underline:before,
.input-data .medium:valid ~ .underline:before{
  transform: scaleX(1);
}
.input-data .underline3{
  position: absolute;
  height: 2px;
  width: 100%;
  bottom: 0px;
}
.input-data .underline3:before{
  position:absolute;
  content: "";
  height: 100%;
  width: 120px;
  background: #06F;
  transform: scaleX(0);
  transform-origin: center;
  transition: transform 0.5s ease-in-out;
}
input[type="checkbox"] {
	margin-right:10px;
}
</style>
<body>
    <div class="input-data">
    <input class="big" type="text" required maxlength="200" autocomplete="off">
    <div class="underline"></div>
    <label>Your name</label></div><br />
    <div class="input-data">
    <input class="big" type="mail" required maxlength="200" autocomplete="off">
    <div class="underline"></div>
    <label>Your e-mail</label></div><br />
    <div class="input-data">
    <input class="big" type="tel" required maxlength="200" autocomplete="off">
    <div class="underline"></div>
    <label>Your telephonenumber</label></div><br />
    <div class="input-data">
    <input class="small" type="number" required autocomplete="off">
    <div class="underline2"></div>
    <label>Adults</label></div><br />
    <div class="input-data">
    <input class="small" type="number" required maxlength="200" autocomplete="off">
    <div class="underline2"></div>
    <label>Children</label></div><br />
    <div class="input-data">
    <input class="medium" type="date" required maxlength="200" autocomplete="off">
    <div class="underline3"></div>
    <label>Reservation date</label></div><br />
    <div class="input-data">
    <input class="small" type="time" required maxlength="200" autocomplete="off">
    <div class="underline2"></div>
    <label>time</label></div><br />
    <div class="input-data">
    <input class="big" type="text" required autocomplete="off" />
    <div class="underline"></div>
    <label>Comment</label></div><br />
    
    <input type="checkbox" id="accept"/><label for="accept">I agree that ...</label>
</body>
