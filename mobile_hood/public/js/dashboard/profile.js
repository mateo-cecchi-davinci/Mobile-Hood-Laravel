document
    .getElementById("triggerFileInput")
    .addEventListener("click", function () {
        document.getElementById("fileInput").click();
    });

document.getElementById("fileInput").addEventListener("change", function () {
    document.getElementById("submitBtn").click();
});

document
    .getElementById("triggerFileLogoInput")
    .addEventListener("click", function () {
        document.getElementById("fileLogoInput").click();
    });

document
    .getElementById("fileLogoInput")
    .addEventListener("change", function () {
        document.getElementById("submitLogoBtn").click();
    });
