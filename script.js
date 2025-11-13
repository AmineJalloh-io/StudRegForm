// Auto date/time
function updateDateTime() {
  const now = new Date();
  document.getElementById("datetime").value = now.toLocaleString();
}
setInterval(updateDateTime, 1000);
updateDateTime();

// Camera setup
const video = document.getElementById('video');
const photoCanvas = document.getElementById('photoCanvas');
const captureBtn = document.getElementById('captureBtn');
const photoData = document.getElementById('photoData');

navigator.mediaDevices.getUserMedia({ video: true })
  .then(stream => { video.srcObject = stream; })
  .catch(err => console.error("Camera access denied:", err));

captureBtn.addEventListener('click', () => {
  const ctx = photoCanvas.getContext('2d');
  ctx.drawImage(video, 0, 0, photoCanvas.width, photoCanvas.height);
  photoCanvas.style.display = 'block';
  photoData.value = photoCanvas.toDataURL('image/jpeg');
});

// Signature setup
const sigCanvas = document.getElementById('signatureCanvas');
const sigCtx = sigCanvas.getContext('2d');
let drawing = false;

sigCanvas.addEventListener('mousedown', () => drawing = true);
sigCanvas.addEventListener('mouseup', () => {
  drawing = false;
  document.getElementById('signatureData').value = sigCanvas.toDataURL('image/png');
});
sigCanvas.addEventListener('mousemove', e => {
  if (!drawing) return;
  const rect = sigCanvas.getBoundingClientRect();
  sigCtx.lineWidth = 2;
  sigCtx.lineCap = 'round';
  sigCtx.strokeStyle = '#000';
  sigCtx.lineTo(e.clientX - rect.left, e.clientY - rect.top);
  sigCtx.stroke();
});

document.getElementById('clearSignature').addEventListener('click', () => {
  sigCtx.clearRect(0, 0, sigCanvas.width, sigCanvas.height);
  document.getElementById('signatureData').value = '';
});