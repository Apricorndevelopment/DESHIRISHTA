<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-Card Creator</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Great+Vibes&family=Lato:wght@300;400;700&family=Montserrat:wght@300;400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fontfaceobserver/2.3.0/fontfaceobserver.standalone.js"></script>

<style>
    /* --- Layout & General Styles --- */
    #ecard-creator {
        padding: 50px 0;
        background: linear-gradient(
            to bottom,
            #ffffff 0%,
            #fedfdfda 45%,
            #fedfdfd0 55%,
            #ffffff 100%
        );
        font-family: 'Lato', sans-serif;
        margin-top: 50px;
    }

    /* Template Scroll */
    .template-scroll-container {
        display: flex;
        overflow-x: auto;
        gap: 15px;
        padding: 15px;
        background: #ffffff8f;
        border: 1px solid #eee;
        border-radius: 8px;
        margin-bottom: 25px;
        scrollbar-width: thin;
        scrollbar-color: maroon #eee;
    }
    
    .template-scroll-container::-webkit-scrollbar { height: 8px; }
    .template-scroll-container::-webkit-scrollbar-track { background: #eee; }
    .template-scroll-container::-webkit-scrollbar-thumb { background-color: #f6af04; border-radius: 10px; }

    .ecard-thumb {
        width: 100px;
        height: 140px;
        object-fit: cover;
        cursor: pointer;
        border-radius: 6px;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        flex-shrink: 0;
    }

    .ecard-thumb:hover, .ecard-thumb.active {
        border-color: maroon;
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(246, 175, 4, 0.3);
    }

    /* Controls Sidebar */
    .controls-box {
        background: #ffffff8e;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        border-top: 4px solid maroon;
        height: 100%;
    }

    .section-title {
        font-weight: 700;
        color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Form Inputs */
    .form-group { margin-bottom: 15px; }
    .ec-label {
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
        font-size: 13px;
        display: block;
    }
    
    .form-control-custom {
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 10px 12px;
        width: 100%;
        font-size: 14px;
        transition: border 0.3s;
    }
    .form-control-custom:focus {
        border-color: maroon;
        outline: none;
    }

    .color-picker-wrapper {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 6px;
        background: #ffffffab;
    }
    
    input[type="color"] {
        border: none;
        width: 40px;
        height: 35px;
        cursor: pointer;
        background: none;
        padding: 0;
    }

    /* Buttons */
    .btn-ecard {
        background:brown;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 6px;
        font-weight: 700;
        transition: 0.3s;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-ecard:hover {
        background: maroon;
        color:white;
        box-shadow: 0 5px 15px rgba(246, 175, 4, 0.4);
    }

    .btn-secondary-custom {
        background: #f8f9fa9d;
        border: 1px solid #ddd;
        color: #333;
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 13px;
        font-weight: 600;
        width: 100%;
        margin-bottom: 10px;
    }
    .btn-secondary-custom:hover { background: #e2e6ea; }

    /* Canvas Area */
    .canvas-wrapper {
        /* background: #e9ecef; */
        padding: 30px;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        max-height: 1100px;
        /* box-shadow: inset 0 0 20px rgba(0,0,0,0.05); */
        overflow: auto;

    }
    .canvas-wrapper::-webkit-scrollbar {
        display: none;
    }

    .canvas-container {
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        background: white;
        /* 🔥 FIXED: Only the container should be relative. */
        /* The canvas elements inside MUST be absolute (handled by FabricJS) to stack correctly. */
        position: relative !important;
    }
    
    /* Removed the rule that forced canvas to be relative, which broke interaction */
    
    /* Header Styles (from your structure) */
    .home-tit h2 {
        font-family: 'Great Vibes', cursive;
        font-size: 40px;
        color: #d63384;
        text-align: center;
    }
    .home-tit p { text-align: center; }
    .wedding-invitation-box {
    position: relative;
    width: 100%;
}

.invitation-message {
    height: 80px;
    width: 80px;
    position: absolute;
    top: 25%;
    right: 90px;
    transform: rotate(35deg);
    z-index: 100;
    /* Smooth transition for when the screen resizes */
    transition: all 0.3s ease-in-out;
}

/* Tablet Screens (e.g., iPads) */
@media (max-width: 1024px) {
    .invitation-message {
        right: 40px;
        height: 70px;
        width: 70px;
    }
}

@media (max-width: 768px) {
    .invitation-message {
        height: 60px;
        width: 60px;
        right: 20px; 
        top: -17%;   
        transform: rotate(40deg); 
    }
}
.wedding-invitation-box{
        position: relative;
        width: 100%;
      
    }

    .invitation-message {
        height: 80px;
        width: 80px;
      
        position: absolute;
        top:25%;
        right: 90px;
        transform: rotate(35deg);
        z-index: 100;
    }
    
</style>
</head>
<body>

<div id="ecard-creator">
    <div class="container">
        
        <!-- Header -->
        <div class="row mb-5">
            <div class="col-12 home-tit">
                <h2><span>Wedding Invitation Designer</span></h2>
                <p>Turn your special day into a lifetime of togetherness - invite others to be part of your special story

</p>
 <!-- <div class="invitation-message">
                    <img src="./images/ecards/1766401976_8646.jpg" height="100%" width="100%" >
                </div> -->
                <span class="leaf1"></span>
                <span class="tit-ani-"></span>
            </div>
        </div>

        <!-- Step 1: Template Selection -->
        <div class="row">
            <div class="col-12">
                <h2 class="ec-label" style="font-size: 20px;"><i class="fa fa-th-large"></i> Select Template</h2>
                <div class="template-scroll-container">
                    
                    <?php
                    // Fetch templates from database
                    if(isset($con)) {
                        $t_sql = mysqli_query($con, "SELECT * FROM tbl_ecard_templates ORDER BY id DESC");
                        if(mysqli_num_rows($t_sql) > 0) {
                            while($t_row = mysqli_fetch_assoc($t_sql)) {
                                $imgUrl = "images/ecards/" . $t_row['template_image'];
                                echo '<img src="'.$imgUrl.'" class="ecard-thumb" onclick="loadTemplate(\''.$imgUrl.'\', this)">';
                            }
                        } else {
                            echo '<p class="text-muted p-2">No templates found.</p>';
                        }
                    } else {
                        echo '<p class="text-muted p-2">Database connection not found.</p>';
                    }
                    ?>
                    
                </div>
            </div>
        </div>

        <!-- Step 2: Editor Interface -->
        <div class="row">
            
            <!-- LEFT COLUMN: Controls -->
            <div class="col-lg-4 mb-4">
                <div class="controls-box">
                    
                    <!-- TAB 1: Event Details Form -->
                 <div class="mb-4">
    <div class="section-title"><i class="fa fa-pencil"></i> Wedding Details</div>
    
    <div class="mb-3 p-2" style="background: #f9f9f9; border-radius: 5px;">
        <label class="ec-label" style="color: #f6af04; font-weight: bold; margin-bottom: 10px; display: block;">GROOM'S SIDE</label>
        
        <label class="ec-label">Groom Name</label>
        <input type="text" id="inp-groom" class="form-control-custom mb-2" value="Rahul" placeholder="Groom Name" oninput="updateFromInput('groom', this.value)">
        
        <div class="row">
            <div class="col-6 pr-1">
                <label class="ec-label">Father's Name</label>
                <input type="text" id="inp-groom-father" class="form-control-custom" value="Ramesh" placeholder="Father's Name" oninput="updateParents('groom')">
            </div>
            <div class="col-6 pl-1">
                <label class="ec-label">Mother's Name</label>
                <input type="text" id="inp-groom-mother" class="form-control-custom" value="Sunita" placeholder="Mother's Name" oninput="updateParents('groom')">
            </div>
        </div>
    </div>

    <div class="mb-3 p-2" style="background: #f9f9f9; border-radius: 5px;">
        <label class="ec-label" style="color: #f6af04; font-weight: bold; margin-bottom: 10px; display: block;">BRIDE'S SIDE</label>
        
        <label class="ec-label">Bride Name</label>
        <input type="text" id="inp-bride" class="form-control-custom mb-2" value="Priya" placeholder="Bride Name" oninput="updateFromInput('bride', this.value)">
        
        <div class="row">
            <div class="col-6 pr-1">
                <label class="ec-label">Father's Name</label>
                <input type="text" id="inp-bride-father" class="form-control-custom" value="Suresh" placeholder="Father's Name" oninput="updateParents('bride')">
            </div>
            <div class="col-6 pl-1">
                <label class="ec-label">Mother's Name</label>
                <input type="text" id="inp-bride-mother" class="form-control-custom" value="Geeta" placeholder="Mother's Name" oninput="updateParents('bride')">
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-6 pr-1">
            <label class="ec-label">Date</label>
            <input type="text" id="inp-date" class="form-control-custom" value="25 Dec 2025" placeholder="Ex. 25 Dec 2025" oninput="updateFromInput('date', this.value)">
        </div>
        <div class="col-6 pl-1">
            <label class="ec-label">Time</label>
            <input type="text" id="inp-time" class="form-control-custom" value="At 7:00 PM" placeholder="Ex. 7:00 PM" oninput="updateFromInput('time', this.value)">
        </div>
    </div>

    <div class="mt-2">
        <label class="ec-label">Venue</label>
        <textarea id="inp-venue" class="form-control-custom" rows="2" placeholder="Ex. Grand Palace Hotel" oninput="updateFromInput('venue', this.value)">Grand Palace Hotel, New Delhi</textarea>
    </div>
</div>
                    
                    <!-- TAB 2: Extra Details -->
                    <div class="mb-4">
                        <div class="section-title"><i class="fa fa-address-card"></i> Contact & Extras</div>
                        
                        <div class="row">
                            <div class="col-6 pr-1">
                                <label class="ec-label">Email ID</label>
                                <input type="text" id="inp-email" class="form-control-custom" value="rsvp@wedding.com" placeholder="Email" oninput="updateFromInput('email', this.value)">
                            </div>
                            <div class="col-6 pl-1">
                                <label class="ec-label">Contact No.</label>
                                <input type="text" id="inp-contact" class="form-control-custom" value="+91 9876543210" placeholder="Mobile" oninput="updateFromInput('contact', this.value)">
                            </div>
                        </div>
                        
                        <div class="mt-2">
                            <label class="ec-label">Other Details</label>
                            <textarea id="inp-other" class="form-control-custom" rows="2" placeholder="RSVP or Special Instructions" oninput="updateFromInput('other', this.value)">RSVP Requested by 20th Dec</textarea>
                        </div>
                    </div>

                    <!-- TAB 3: Styling -->
                    <div class="mb-4">
                        <div class="section-title"><i class="fa fa-paint-brush"></i> Styling</div>
                        <p style="font-size: 12px; color: #888; font-style: italic;">Select any text on the card to change its style.</p>

                        <label class="ec-label">Font Style</label>
                        <select id="font-family" class="form-control-custom">
                            <option value="Great Vibes">Cursive (Great Vibes)</option>
                            <option value="Cinzel">Royal (Cinzel)</option>
                            <option value="Playfair Display">Classic (Playfair)</option>
                            <option value="Montserrat">Modern (Montserrat)</option>
                            <option value="Lato">Simple (Lato)</option>
                        </select>

                        <div class="row mt-2">
                            <div class="col-6">
                                <label class="ec-label">Color</label>
                                <div class="color-picker-wrapper">
                                    <input type="color" id="text-color" value="#000000">
                                    <span style="font-size: 12px; margin-left: 8px; color: #555;">Pick</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="ec-label">Size</label>
                                <input type="number" id="font-size" class="form-control-custom" value="40">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4 pt-3" style="border-top: 1px solid #eee;">
                        <button class="btn btn-secondary-custom" onclick="addCustomText()">
                            <i class="fa fa-plus"></i> Add Extra Text
                        </button>
                        <button class="btn btn-secondary-custom" onclick="deleteSelected()" style="color: #dc3545; border-color: #dc3545;">
                            <i class="fa fa-trash"></i> Delete Selected
                        </button>
                        <button class="btn btn-ecard mt-2" onclick="downloadCard()">
                            <i class="fa fa-download"></i> Download Invitation
                        </button>
                        <!-- <div class="d-flex gap-2 mb-2">
                            <button class="btn btn-secondary-custom" onclick="zoomOut()">➖ Zoom Out</button>
                            <button class="btn btn-secondary-custom" onclick="zoomIn()">➕ Zoom In</button>
                            <button class="btn btn-secondary-custom" onclick="resetZoom()">🔄 Reset</button>
                        </div> -->

                    </div>

                </div>
            </div>

            <!-- RIGHT COLUMN: Canvas -->
            <div class="col-lg-8">
                <div class="canvas-wrapper">
                    <canvas id="c" width="500" height="700"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="zoom-controls">
    <button class="btn btn-secondary-custom" onclick="zoomOut()">➖</button>
    <button class="btn btn-secondary-custom" onclick="zoomIn()">➕</button>
    <button class="btn btn-secondary-custom" onclick="resetZoom()">🔄</button>
</div>
<style>
    .zoom-controls {
    position: fixed;
    bottom: 300px;
    right: 20px;
    display: flex;
    flex-direction: column;   /* column format */
    gap: 10px;
    z-index: 9999;
    /* background-color: white;            sabke upar rahe */
}

.zoom-controls button {
    min-width: 40px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.canvas-container {
    position: relative !important;
}


</style>
<script>
      // --- Initialize Fabric Canvas ---
    var canvas = new fabric.Canvas('c', {
        preserveObjectStacking: true
    });
  // =======================
// 🔍 CANVAS ZOOM CONTROLS
// =======================
var currentZoom = 1;
var zoomStep = 0.1;
var minZoom = 0.4;
var maxZoom = 2;

function zoomIn() {
    if (currentZoom < maxZoom) {
        currentZoom += zoomStep;
        applyZoom();
    }
}

function zoomOut() {
    if (currentZoom > minZoom) {
        currentZoom -= zoomStep;
        applyZoom();
    }
}

function resetZoom() {
    currentZoom = 1;
    canvas.setViewportTransform([1, 0, 0, 1, 0, 0]); // 🔥 HARD RESET
    canvas.requestRenderAll();
}
function applyZoom() {

    const zoom = currentZoom;

    // 🔥 zoom at top-left (NOT center)
    canvas.zoomToPoint(new fabric.Point(0, 0), zoom);

    const vpt = canvas.viewportTransform;

    // 👉 LEFT align (X axis)
    vpt[4] = 20;   // left se gap (0 bhi rakh sakte ho)

    // 👉 TOP align (Y axis)
    vpt[5] = 20;

    canvas.setViewportTransform(vpt);
    canvas.requestRenderAll();
}


    // Global variable to track current template
    var currentTemplateUrl = '';

    // --- Load Template ---
    function loadTemplate(url, element) {
        currentTemplateUrl = url;

        // UI: Highlight active thumbnail
        var thumbs = document.querySelectorAll('.ecard-thumb');
        thumbs.forEach(t => t.classList.remove('active'));
        if(element) element.classList.add('active');

        fabric.Image.fromURL(url, function(img) {
            // Logic to fit image within the canvas
            var maxWidth = 600; 
            var scale = 1;
            if(img.width > maxWidth) {
                scale = maxWidth / img.width;
            }

            var newWidth = img.width * scale;
            var newHeight = img.height * scale;

            canvas.setWidth(newWidth);
            canvas.setHeight(newHeight);
            
            // 1. Set Background
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                scaleX: scale,
                scaleY: scale,
                originX: 'left',
                originY: 'top',
                crossOrigin: 'anonymous' // Enable CORS
            });
            
            // 2. Remove existing objects (cleanup)
            canvas.getObjects().forEach(o => canvas.remove(o));
            
            // 3. Add Structured Text (initially black/gray)
            addStructuredText();

            // 4. 🔥 AUTO COLOR ADJUST (Calculates brightness & updates text color)
            autoAdjustTextColor(url);

        }, { crossOrigin: 'anonymous' });
    }

    // Load first template on page load
    window.onload = function() {
        var first = document.querySelector('.ecard-thumb');
        if(first) {
            loadTemplate(first.src, first);
        }
    };

    // --- Helper: Construct Parent String ---
    function getParentString(side) {
        var father = document.getElementById('inp-' + side + '-father').value;
        var mother = document.getElementById('inp-' + side + '-mother').value;
        var prefix = side === 'groom' ? 'S/o ' : 'D/o ';
        
        if(father && mother) return prefix + 'Mr. ' + father + ' & Mrs. ' + mother;
        if(father) return prefix + 'Mr. ' + father;
        if(mother) return prefix + 'Mrs. ' + mother;
        return prefix + 'Mr. & Mrs. Sharma'; // Default
    }

   function addStructuredText() {

    var centerX = canvas.width / 2;
    var verticalOffset = 130; 

    // Helper to create text with ID
    function createText(id, text, top, fontFamily, fontSize, color, style = 'normal') {

        var el = document.getElementById('inp-' + id);
        var inputVal = el ? el.value : '';
        var finalTxt = inputVal ? inputVal : text;

        var obj = new fabric.IText(finalTxt, {
            left: centerX,
            top: top + verticalOffset, 
            originX: 'center',
            fontFamily: fontFamily,
            fontSize: fontSize,
             fontWeight: 'normal',
            fill: color,
            fontStyle: style,
            id: id
        });

        canvas.add(obj);
    }

    // 1. Tagline
    createText('tagline', 'Together with our families', 60, 'Montserrat', 18, '#555555');

    // 2. Groom
    createText('groom', 'Rahul', 110, 'Great Vibes', 60, '#000000');

    // Groom Parents
    var groomParentsTxt = getParentString('groom');
    canvas.add(new fabric.IText(groomParentsTxt, {
        left: centerX,
        top: 170 + verticalOffset,
        originX: 'center',
        fontFamily: 'Montserrat',
        fontSize: 16,
        fill: '#555555',
        id: 'groom-parents'
    }));

    // 3. Weds
    createText('weds', 'weds', 220, 'Playfair Display', 25, '#777777', 'italic');

    // 4. Bride
    createText('bride', 'Priya', 260, 'Great Vibes', 60, '#000000');

    // Bride Parents
    var brideParentsTxt = getParentString('bride');
    canvas.add(new fabric.IText(brideParentsTxt, {
        left: centerX,
        top: 320 + verticalOffset,
        originX: 'center',
        fontFamily: 'Montserrat',
        fontSize: 16,
        fill: '#555555',
        id: 'bride-parents'
    }));

    // 5. Date
    createText('date', '25 Dec 2025', 400, 'Cinzel', 28, '#333333');

    // 6. Time
    createText('time', 'At 7:00 PM', 440, 'Lato', 20, '#555555');

    // 7. Venue
    createText('venue', 'Grand Palace Hotel, New Delhi', 480, 'Lato', 22, '#333333');

    // 8. Extras
    createText('email', 'rsvp@wedding.com', 520, 'Lato', 16, '#555555');
    createText('contact', '+91 9876543210', 545, 'Lato', 16, '#555555');
    createText('other', 'RSVP Requested', 570, 'Lato', 14, '#777777', 'italic');

    canvas.renderAll();
}

    // --- LIVE SYNC: Simple Fields ---
    function updateFromInput(id, value) {
        var objects = canvas.getObjects();
        var target = objects.find(o => o.id === id);

        if(target) {
            target.set('text', value);
            canvas.renderAll();
        }
    }

    // --- LIVE SYNC: Parent Fields ---
    function updateParents(side) {
        var objects = canvas.getObjects();
        var target = objects.find(o => o.id === side + '-parents'); // e.g. groom-parents

        if(target) {
            var newText = getParentString(side);
            target.set('text', newText);
            canvas.renderAll();
        }
    }

    // --- CANVAS EVENTS: Selection -> Update Controls ---
    canvas.on('selection:created', updateControlsFromSelection);
    canvas.on('selection:updated', updateControlsFromSelection);
    
    function updateControlsFromSelection() {
        var obj = canvas.getActiveObject();
        if(obj && (obj.type === 'i-text' || obj.type === 'text')) {
            // Update Style Controls
            document.getElementById('font-family').value = obj.fontFamily;
            document.getElementById('text-color').value = obj.fill;
            document.getElementById('font-size').value = obj.fontSize;
        }
    }

    const fontFamilies = [
      'Great Vibes',
      'Cinzel',
      'Montserrat',
      'Playfair Display',
      'Lato'
    ];

    Promise.all(
      fontFamilies.map(font => new FontFaceObserver(font).load())
    ).then(() => {
      console.log('All fonts loaded');
      canvas.renderAll();
    });

    // --- STYLE CONTROLS: Change Canvas Object ---
    document.getElementById('font-family').addEventListener('change', function () {
        var obj = canvas.getActiveObject();
        if (!obj || (obj.type !== 'i-text' && obj.type !== 'text')) return;

        obj.set({
            fontFamily: this.value,
            fontWeight: 'normal',   // 🔥 important
            fontStyle: 'normal',    // 🔥 important
            dirty: true             // 🔥 export fix
        });

        canvas.requestRenderAll();
    });


    // --- Add Extra Manual Text ---
    function addCustomText() {
        var text = new fabric.IText('New Text', {
            left: canvas.width / 2,
            top: canvas.height / 2,
            originX: 'center',
            fontFamily: 'Lato',
            fill: '#000000',
            fontSize: 30
        });
        canvas.add(text);
        canvas.setActiveObject(text);
    }

    // --- Delete ---
    function deleteSelected() {
        var obj = canvas.getActiveObject();
        if(obj) {
            // If it's a linked object, clear the input?
            if(obj.id && document.getElementById('inp-'+obj.id)) {
                document.getElementById('inp-'+obj.id).value = '';
            }
            canvas.remove(obj);
            canvas.discardActiveObject();
            canvas.renderAll();
        }
    }

    // --- Download ---
     function downloadCard() {

        const fonts = [
            new FontFaceObserver('Great Vibes'),
            new FontFaceObserver('Cinzel'),
            new FontFaceObserver('Montserrat'),
            new FontFaceObserver('Playfair Display'),
            new FontFaceObserver('Lato')
        ];

        Promise.all(fonts.map(font => font.load()))
            .then(() => {
                // Fonts loaded – now export
                canvas.discardActiveObject();

                canvas.getObjects().forEach(obj => {
                    if (obj.type === 'i-text') {
                        obj.set('dirty', true);
                    }
                });

                canvas.renderAll();

                var dataURL = canvas.toDataURL({
                    format: 'png',
                    quality: 1,
                    multiplier: 2
                });

                var link = document.createElement('a');
                link.download = 'Invitation.png';
                link.href = dataURL;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            })
            .catch(err => {
                alert('Font loading failed. Please try again.');
                console.error(err);
            });
    }

    document.getElementById('text-color').addEventListener('input', function () {
        var obj = canvas.getActiveObject();
        if (!obj || (obj.type !== 'i-text' && obj.type !== 'text')) return;

        obj.set({
            fill: this.value,
            dirty: true
        });

        canvas.requestRenderAll();
    });

    document.getElementById('font-size').addEventListener('input', function () {
        var obj = canvas.getActiveObject();
        if (!obj || (obj.type !== 'i-text' && obj.type !== 'text')) return;

        obj.set({
            fontSize: parseInt(this.value, 10),
            dirty: true
        });

        canvas.requestRenderAll();
    });

    // ===========================================
    // 🔥🔥 NEW FEATURE: Auto Color Adjust Logic 🔥🔥
    // ===========================================

    function autoAdjustTextColor(bgImageUrl) {
        getImageBrightness(bgImageUrl, function (brightness) {
            
            // If brightness is low (<130), background is dark -> Use White Text
            // If brightness is high (>130), background is light -> Use Black Text
            var textColor = brightness < 130 ? '#ffffff' : '#000000';
            
            // Also update the color picker UI to reflect this auto-choice
            document.getElementById('text-color').value = textColor;

            canvas.getObjects().forEach(obj => {
                if (obj.type === 'i-text') {
                    obj.set({
                        fill: textColor,
                        dirty: true
                    });
                }
            });

            canvas.renderAll();
        });
    }

    function getImageBrightness(imageUrl, callback) {
        var img = new Image();
        img.crossOrigin = "Anonymous";
        img.src = imageUrl;

        img.onload = function () {
            var canvasTmp = document.createElement("canvas");
            var ctx = canvasTmp.getContext("2d");

            // Resize for faster processing (no need to scan full HD image)
            canvasTmp.width = 100;
            canvasTmp.height = 100;

            ctx.drawImage(img, 0, 0, 100, 100);

            var imageData = ctx.getImageData(0, 0, canvasTmp.width, canvasTmp.height);
            var data = imageData.data;

            var colorSum = 0;

            for (var i = 0; i < data.length; i += 4) {
                var r = data[i];
                var g = data[i + 1];
                var b = data[i + 2];
                var avg = (r + g + b) / 3;
                colorSum += avg;
            }

            var brightness = colorSum / (canvasTmp.width * canvasTmp.height);
            callback(brightness);
        };
    }

</script>

<?php include 'footer.php'; ?>
</body>
</html>