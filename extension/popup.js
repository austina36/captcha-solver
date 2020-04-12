
function handleMessage(request) {
  console.log("Message from the background script: " + request.captcha);
  str = request.captcha;
  str = str.slice(1, -1);
  document.getElementById("captcha").innerHTML = str;
}

browser.runtime.onMessage.addListener(handleMessage);

browser.runtime.sendMessage({ action: 'start-native-messaging' });




