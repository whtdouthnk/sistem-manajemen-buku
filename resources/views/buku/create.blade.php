@include('layout.header')

<h3 class="header-h3">Tambah Buku</h3>
<form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data" id="form-buku">
    @csrf

    <div class="mb-4">
        <label class="block font-bold mb-2" for="judul">Judul</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="judul" id="judul" placeholder="Masukkan judul" value="{{ old('judul') }}">
        @error('judul')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="pengarang">Pengarang</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="pengarang" id="pengarang" placeholder="Masukkan nama pengarang" value="{{ old('pengarang') }}">
        @error('pengarang')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="tahun_terbit">Tahun Terbit</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded" type="text" name="tahun_terbit" id="tahun_terbit" placeholder="Masukkan tahun terbit" value="{{ old('tahun_terbit') }}">
        @error('tahun_terbit')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="penerbit_id">Penerbit</label>
        <select name="penerbit_id" id="penerbit_id" class="w-full px-3 py-2 border border-gray-300 rounded bg-white">
            <option value="" disabled {{ old('penerbit_id') == '' ? 'selected' : '' }}>-- Pilih Penerbit --</option>
            @foreach ($penerbit as $p)
                <option value="{{ $p->id }}" {{ old('penerbit_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_penerbit }}</option>
            @endforeach
        </select>
        @error('penerbit_id')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="kategori_id">Kategori</label>
        <select name="kategori_id" id="kategori_id" class="w-full px-3 py-2 border border-gray-300 rounded bg-white">
            <option value="" disabled {{ old('kategori_id') == '' ? 'selected' : '' }}>-- Pilih Kategori --</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
        @error('kategori_id')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="file_cover">Gambar Sampul</label>
        <input class="w-full px-3 py-2 border border-gray-300 rounded bg-white" type="file" name="file_cover" id="file_cover">
        @error('file_cover')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2" for="deskripsi">Deskripsi</label>
        
        <!-- Toolbar Editor -->
        <div class="editor-toolbar border border-gray-300 border-b-0 bg-gray-50 p-2 rounded-t">
            <button type="button" class="toolbar-btn" data-command="bold" title="Bold">
                <strong>B</strong>
            </button>
            <button type="button" class="toolbar-btn" data-command="italic" title="Italic">
                <em>I</em>
            </button>
            <button type="button" class="toolbar-btn" data-command="underline" title="Underline">
                <u>U</u>
            </button>
            <button type="button" class="toolbar-btn" data-command="insertUnorderedList" title="Bullet List">
                • List
            </button>
            <button type="button" class="toolbar-btn" data-command="insertOrderedList" title="Numbered List">
                1. List
            </button>
            <select class="toolbar-select" data-command="formatBlock">
                <option value="">Paragraph</option>
                <option value="h1">Heading 1</option>
                <option value="h2">Heading 2</option>
                <option value="h3">Heading 3</option>
                <option value="h4">Heading 4</option>
            </select>
            <select class="toolbar-select" data-command="fontSize">
                <option value="1">Small</option>
                <option value="3" selected>Normal</option>
                <option value="5">Large</option>
                <option value="7">X-Large</option>
            </select>
            <input type="color" class="toolbar-color" data-command="foreColor" title="Text Color">
            <input type="color" class="toolbar-color" data-command="backColor" title="Background Color" value="#ffffff">
        </div>
        
        <!-- Editor Area -->
        <div 
            id="editor" 
            class="w-full px-3 py-2 border border-gray-300 rounded-b bg-white min-h-[200px] max-h-[400px] overflow-y-auto"
            contenteditable="true"
        >{!! old('deskripsi') !!}</div>
        
        <!-- Hidden textarea untuk form submission -->
        <textarea name="deskripsi" id="deskripsi" class="hidden">{{ old('deskripsi') }}</textarea>
        
        @error('deskripsi')
            <div class="mt-1 text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-blue">Simpan</button>
</form>

<style>
.editor-toolbar {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
    align-items: center;
}

.toolbar-btn {
    padding: 5px 10px;
    border: 1px solid #ccc;
    background: white;
    border-radius: 3px;
    cursor: pointer;
    font-size: 14px;
}

.toolbar-btn:hover {
    background: #f0f0f0;
}

.toolbar-btn.active {
    background: #e0e0e0;
    border-color: #999;
}

.toolbar-select {
    padding: 4px 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    background: white;
    font-size: 14px;
}

.toolbar-color {
    width: 40px;
    height: 30px;
    border: 1px solid #ccc;
    border-radius: 3px;
    cursor: pointer;
}

#editor {
    line-height: 1.6;
    font-family: Arial, sans-serif;
}

#editor:focus {
    outline: 2px solid #3b82f6;
    outline-offset: -2px;
}

#editor h1, #editor h2, #editor h3, #editor h4 {
    margin: 10px 0;
    font-weight: bold;
}

#editor h1 { font-size: 24px; }
#editor h2 { font-size: 20px; }
#editor h3 { font-size: 18px; }
#editor h4 { font-size: 16px; }

#editor ul, #editor ol {
    margin: 10px 0;
    padding-left: 30px;
}

#editor blockquote {
    border-left: 4px solid #ccc;
    margin: 10px 0;
    padding-left: 15px;
    color: #666;
    font-style: italic;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editor = document.getElementById('editor');
    const hiddenTextarea = document.getElementById('deskripsi');
    const toolbarButtons = document.querySelectorAll('.toolbar-btn');
    const toolbarSelects = document.querySelectorAll('.toolbar-select');
    const toolbarColors = document.querySelectorAll('.toolbar-color');
    const form = document.getElementById('form-buku');

    // Fungsi untuk menjalankan perintah editor
    function execCommand(command, value = null) {
        document.execCommand(command, false, value);
        editor.focus();
        updateHiddenField();
    }

    // Update hidden textarea dengan konten editor
    function updateHiddenField() {
        hiddenTextarea.value = editor.innerHTML;
    }

    // Event listeners untuk toolbar buttons
    toolbarButtons.forEach(button => {
        button.addEventListener('click', function() {
            const command = this.getAttribute('data-command');
            execCommand(command);
            
            // Toggle active state untuk format buttons
            if (['bold', 'italic', 'underline'].includes(command)) {
                this.classList.toggle('active');
            }
        });
    });

    // Event listeners untuk select elements
    toolbarSelects.forEach(select => {
        select.addEventListener('change', function() {
            const command = this.getAttribute('data-command');
            const value = this.value;
            execCommand(command, value);
        });
    });

    // Event listeners untuk color pickers
    toolbarColors.forEach(color => {
        color.addEventListener('change', function() {
            const command = this.getAttribute('data-command');
            const value = this.value;
            execCommand(command, value);
        });
    });

    // Update hidden field saat ada perubahan di editor
    editor.addEventListener('input', updateHiddenField);
    editor.addEventListener('paste', function(e) {
        // Allow paste event to complete first
        setTimeout(updateHiddenField, 0);
    });

    // Pastikan hidden field terupdate sebelum form submit
    form.addEventListener('submit', function(e) {
        updateHiddenField();
        
        // Validasi sederhana - pastikan ada konten
        if (!editor.textContent.trim()) {
            e.preventDefault();
            alert('Deskripsi buku tidak boleh kosong');
            editor.focus();
        }
    });

    // Inisialisasi konten editor
    if (hiddenTextarea.value) {
        editor.innerHTML = hiddenTextarea.value;
    }

    // Focus editor ketika diklik
    editor.addEventListener('click', function() {
        this.focus();
    });

    // Handle tab di dalam editor
    editor.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();
            execCommand('insertHTML', '&nbsp;&nbsp;&nbsp;&nbsp;');
        }
    });
});
</script>

@include('layout.footer')