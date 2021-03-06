// Register service worker to control making site work offline / notifications
if ('serviceWorker' in navigator) {
    navigator.serviceWorker
             .register('service-worker.js')
             .then(function() { console.log('Service Worker Registered'); });
  }

// PUSH Notification

// Ask for Permission
// Notification.requestPermission(function(status) {
//    console.log('Notification permission status:', status);
//  });

// // Send notification if granted
// function displayNotification() {
//    if (Notification.permission == 'granted') {
//      navigator.serviceWorker.getRegistration().then(function(req) {
//        var options = {
//          body: 'This is the BODY!',
//          icon: 'images/icons/iphone/icon_iphone_orange.png',
//          vibrate: [0, 100, 0],
//          data: {
//            dateOfArrival: Date.now,
//            primaryKey: 1
//          },
//          actions: [
//            {action: 'explore', title: 'Visit SPIE Grades',
//              icon: 'images/icons/checkmark.png'},
//            {action: 'close', title: 'Close Notification',
//              icon: 'images/icons/x.png'},
//          ]
//        };
//        req.showNotification('Test Notification', options);
//      });
//    }
//  }
// // Check if subscription was made
// if ('serviceWorker' in navigator) {
//   navigator.serviceWorker.register('service-worker.js').then(function(reg) {
//     console.log('Service Worker Registered!', reg);

//     reg.pushManager.getSubscription().then(function(sub) {
//       if (sub === null) {
//         // Update UI to ask user to register for Push
//         console.log('Not subscribed to push service!');
//       } else {
//         // We have a subscription, update the database
//         console.log('Subscription object: ', sub);
//       }
//     });
//   }).catch(function(err) {
//     console.log('Service Worker registration failed: ', err);
//   });
// }
// function subscribeUser() {
//   if ('serviceWorker' in navigator) {
//     navigator.serviceWorker.ready.then(function(reg) {
//       reg.pushManager.subscribe({
//         userVisibleOnly: true
//       }).then(function(sub) {
//         console.log('Endpoint URL: ', sub.endpoint);
//       }).catch(function(e) {
//         if (Notification.permission === 'denied') {
//           console.warn('Permission for notifications was denied');
//         } else {
//           console.error('Unable to subscribe to push', e);
//         }
//       })
//     })
//   }
// }


// LOCAL Notification


// var $status = document.getElementById('status');

// if ('Notification' in window) {
//   $status.innerText = Notification.permission;
// }

// function requestPermission() {
//   if (!('Notification' in window)) {
//     alert('Notification API not supported!');
//     return;
//   }
  
//   Notification.requestPermission(function (result) {
//     $status.innerText = result;
//   });
// }

// function nonPersistentNotification() {
//   if (!('Notification' in window)) {
//     alert('Notification API not supported!');
//     return;
//   }
  
//   try {
//     var notification = new Notification("Hi there - non-persistent!");
//   } catch (err) {
//     alert('Notification API error: ' + err);
//   }
// }

// function persistentNotification() {
//   if (!('Notification' in window) || !('ServiceWorkerRegistration' in window)) {
//     alert('Persistent Notification API not supported!');
//     return;
//   }
  
//   try {
//     navigator.serviceWorker.getRegistration()
//       .then((reg) => reg.showNotification("Hi there - persistent!"))
//       .catch((err) => alert('Service Worker registration error: ' + err));
//   } catch (err) {
//     alert('Notification API error: ' + err);
//   }
// }
// if (Notification.permission == "granted") {
//   setInterval(persistentNotification, 5000);
// } else {
//   console.log("NO");
// }