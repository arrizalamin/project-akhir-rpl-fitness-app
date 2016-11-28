class Timer {
  constructor(node) {
    this.time = 1;
    this.node = node;
  }

  increment() {
    var minute = Math.floor(this.time / 60);
    var second = this.time % 60;
    var timeString = second < 10 ? '0' + second : second;
    if (minute > 0) {
      timeString = minute + ':' + timeString;
    }
    this.node.innerHTML = timeString;
    this.time++;
  };

  start() {
    this.interval = setInterval(this.increment.bind(this), 1000);
  }

  stop(innerText) {
    clearInterval(this.interval);
    this.node.innerHTML += '<br />' + innerText;
    return this.time;
  }
}
window.Timer = Timer;