(function() {
  console.log('hello motherfather');

  const notifPanel = document.getElementById('notifPanel');
  if (notifPanel) {
    notifPanel.addEventListener('click', e => {
      // Reject  
      if (e.target.matches('.reject-request')) {
        const reqId = e.target.dataset.requestId;
        fetch('reject_request.php', {
          method: 'POST',
          headers: {'Content-Type':'application/x-www-form-urlencoded'},
          body: `request_id=${encodeURIComponent(reqId)}`
        })
        .then(r => r.json())
        .then(json => {
          if (json.status === 'ok') {
            e.target.closest('li').remove();
          } else {
            alert('Could not reject: ' + (json.msg||json.status));
          }
        })
        .catch(() => alert('Network error.'));
        return;
      }

      // Accept  
      if (e.target.matches('.accept-request')) {
        const reqId = e.target.dataset.requestId;
        location.href = `chat.php?request_id=${reqId}`;
        return;
      }
    });
  }

  console.log('hello motherfather2');
})();
