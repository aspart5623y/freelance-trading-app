function uploadedFile(e) {
    e.preventDefault()
    console.log(e.value);
    let uploadedFile = e.target.files[0];
    let componentDiv = e.target.parentElement
    let parentDiv = e.target.parentElement.parentElement

    componentDiv.style.display = "none";
    parentDiv.innerHTML = `
        <div class="progress" style="height: 4px">
            <div class="progress-bar bg-red" style="width: 5%;"></div>
        </div>
        <div class="d-flex align-items-center">
            <span class="text-muted">${uploadedFile.name}</span>
            <button type="button" onclick="clearFile()" class="btn">&times;</button>
        </div>
    `

    setInterval(() => {
        let newwidth = 0
        for (let i = 0; i < 100; i++) {
            newwidth = newwidth + 1
        }
        parentDiv.querySelector('.progress-bar').style.width = newwidth + '%'
    }, 500)

    clearInterval()

    setTimeout(() => {
        parentDiv.querySelector('.progress-bar').classList.remove('bg-red')
        var src = URL.createObjectURL(uploadedFile);
        parentDiv.innerHTML = `
            <div class="file-component">
                <span class="d-block text-center position-relative overflow-hidden w-100">
                    <span class="position-absolute top-50 start-50 translate-middle bg-dark text-white rounded-circle d-flex justify-content-center align-items-center p-2">
                        <i class="fas fa-pen" style="font-size: 17px;"></i>
                    </span>
                    <img src="${src}" width="100%" />
                </span>
                <input type="file" class="form-control" onchange="uploadedFile(event)">
            </div>
            <div class="d-flex align-items-center">
            <span class="text-muted">${uploadedFile.name}</span>
            <button type="button" onclick="clearFile(event)" class="btn">&times;</button>
        </div>
        `
    }, 1500)
    

}

function clearFile(e) {
    let parentDiv = e.target.parentElement.parentElement;
    parentDiv.innerHTML = `
        <div class="file-component">
            <span class="d-block text-center w-100">
                <i class="fas fa-cloud-upload-alt" style="font-size: 20px;"></i>
                <p><span class="text-primary">Click to upload</span> or drag and drop</p>
                <span class="fw-lighter">PDF, JPG, PNG or DOCX (max 2mb)</span>
            </span>
            <input type="file" class="form-control" onchange="uploadedFile(event)">
        </div>
    `
}