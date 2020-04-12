
function handleRequest(request) {
  
  if (request.action == 'start-native-messaging') {
    console.log("Received from popup.js: " + request.action);
    
    // Connect to app
    var port = browser.runtime.connectNative("captcha");
    console.log("Connected to native application");
    
    // Listen for messages from the app
    port.onMessage.addListener((response) => {
      msg = JSON.stringify(response)
      console.log("Received: " + msg);
      if (msg) {
        browser.runtime.sendMessage({captcha: msg});
      }
    });
    
    // Send URL of captcha to app
    browser.tabs.query({currentWindow: true, active: true})
      .then((tabs) => {
        // Convert data to JSON
        var link = {"url": tabs[0].url};
        var linkJSON = JSON.stringify(link);
        // Send data to app
        port.postMessage(JSON.parse(linkJSON));
    });

  }

}

// Listen for messages from popup.js
browser.runtime.onMessage.addListener(handleRequest)
