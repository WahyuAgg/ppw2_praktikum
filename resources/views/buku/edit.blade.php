@extends('layouts.template')

@section('title', 'Edit Buku')
@section('name_page','Edit Buku')
@section('content')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <div class="container mt-5">
        <h4 class="mb-4">Edit Buku</h4>
        <form method="post" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input class="form-control" type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" >
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input class="form-control" type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku->penulis) }}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input class="form-control" type="text" name="harga" id="harga" value="{{ old('harga', $buku->harga) }}">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input class="form-control" type="date" name="tgl_terbit" id="tgl_terbit" value="{{ old('tgl_terbit', $buku->tgl_terbit->format('Y-m-d')) }}">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a href="/buku" class="btn btn-secondary">Batal</a>
            </div>
        </form>
        {{--
        git clone <link>
        composer install
        php artisan serve

        --}}
    </div>
@endsection

{{--
    1. Basic Setup
git config --global user.name "Your Name": Sets the name you want attached to your commit messages.
git config --global user.email "youremail@example.com": Sets the email you want attached to your commit messages.
git config --global color.ui auto: Enables helpful colorization of command line output.
    2. Repository Management
git init: Initializes a new Git repository.
git clone <repository-url>: Clones an existing repository from a remote location (e.g., GitHub).
    3. Staging & Committing
git add <file>: Stages a file (or files) for commit.
git add .: Stages all changes (new, modified, and deleted files) for the next commit.
git commit -m "Commit message": Commits the staged changes with a descriptive message.
git commit --amend: Modifies the most recent commit message or staged changes.
    4. Branching
git branch: Lists all branches in your repository.
git branch <branch-name>: Creates a new branch.
git checkout <branch-name>: Switches to another branch.
git checkout -b <branch-name>: Creates a new branch and switches to it.
git merge <branch-name>: Merges the specified branch into the current branch.
git branch -d <branch-name>: Deletes a branch locally.
    5. Viewing Changes
git status: Shows the current state of the working directory and staging area.
git diff: Displays changes between the working directory and the staging area.
git diff <branch>: Compares your current branch with another branch.
git log: Shows a history of commits.
git show <commit-hash>: Displays detailed information about a specific commit.
    6. Remote Repositories
git remote add origin <repository-url>: Adds a remote repository URL.
git remote -v: Lists remote connections.
git push origin <branch-name>: Pushes commits from the local branch to the remote branch.
git pull origin <branch-name>: Pulls the latest changes from the remote repository to your local branch.
git fetch: Fetches changes from the remote without merging them.
    7. Tagging
git tag: Lists all tags in the repository.
git tag <tag-name>: Creates a new tag.
git push origin <tag-name>: Pushes a tag to the remote repository.
git push origin --tags: Pushes all tags to the remote repository.
    8. Undoing Changes
git reset <file>: Unstages a file (without affecting its content).
git reset --hard <commit-hash>: Resets the current branch to a specific commit, discarding all changes.
git revert <commit-hash>: Reverts the changes of a specific commit by creating a new commit.
git stash: Saves changes to a temporary stack, allowing you to work on something else.
git stash apply: Reapplies the stashed changes.
    9. Collaborating
git pull: Fetches changes from the remote repository and merges them into your local branch.
git rebase <branch-name>: Reapplies commits on top of another base branch.
git cherry-pick <commit-hash>: Applies a specific commit from one branch into another branch.
    10. Inspection
git blame <file>: Shows who made the changes to each line in a file.
git bisect: Helps to find a commit that introduced a bug using binary search.
git reflog: Shows a log of changes to the local repository (useful for recovering lost commits).
    11. Cleaning Up
git clean -f: Removes untracked files from the working directory.
git gc: Optimizes the local repository by cleaning up unnecessary files and compressing file history.

1. Membuat Repository di GitHub
2. Buat Repository di Lokal
    git init
3. Menambahkan File ke Repository Lokal
    git status
    git add .
4. Commit Perubahan
    git commit -m "Initial commit"
5. Hubungkan Repository Lokal ke GitHub
tambah remote
    git remote add [nama-remote] [url-repository]
    git remote add origin https://github.com/<username>/<repository-name>.git
mengubah urrl remote
    git remote set-url origin https://github.com/user/new-repo.git
info remote
    git remote show [nama-remote]
    git remote
    git remote -v
6. Push Project ke GitHub
    git push -u origin master

_______
cara membuat, model, migration, seeder dan factoty sekaligus
php artisan make:model ModelName -mfsc

php artisan storage:link


--}}



