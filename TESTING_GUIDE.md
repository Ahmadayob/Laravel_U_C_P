# 🧪 RBAC System Testing Guide

## Manual Testing Instructions

Since you have the server running at http://127.0.0.1:8000, follow these steps to test the RBAC system:

---

## 📋 Test Plan

### Test 1: Viewer Role (Read-Only Access)

**Login Credentials:**
- Email: `viewer@example.com`
- Password: `password`

**Expected Behavior:**
1. Navigate to http://127.0.0.1:8000/login
2. Login with viewer credentials
3. Go to http://127.0.0.1:8000/blog

**What You Should See:**
- ✅ All blog posts are visible
- ✅ Can click on posts to read them
- ❌ **NO** "Create" button at the top
- ❌ **NO** "Edit" buttons on any posts
- ❌ **NO** "Delete" buttons on any posts
- ✅ Post owner information displayed (name and role)

**What to Test:**
- Try to access `/blog/create` directly → Should get **403 Forbidden**
- Try to access `/blog/{id}/edit` directly → Should get **403 Forbidden**
- Verify you can view all posts without issues

---

### Test 2: Editor Role (Create & Modify Own)

**Login Credentials:**
- Email: `editor@example.com`
- Password: `password`

**Expected Behavior:**
1. Logout from viewer account
2. Login with editor credentials
3. Go to http://127.0.0.1:8000/blog

**What You Should See:**
- ✅ All blog posts are visible
- ✅ **"Create" button** at the top right
- ✅ **"Edit" button** ONLY on posts created by editor@example.com
- ✅ **"Delete" button** ONLY on posts created by editor@example.com
- ❌ **NO** Edit/Delete buttons on posts created by others

**What to Test:**
1. **Create a new post:**
   - Click "Create" button
   - Fill in: Title, Author, Body
   - Submit
   - Should redirect to /blog with success message
   - Your new post should appear with Edit/Delete buttons

2. **Edit your own post:**
   - Click "Edit" on a post you created
   - Modify the content
   - Save
   - Should update successfully

3. **Try to edit someone else's post:**
   - Find a post created by admin@example.com
   - You should NOT see Edit/Delete buttons
   - Try accessing `/blog/{admin-post-id}/edit` directly
   - Should get **403 Forbidden**

4. **Delete your own post:**
   - Click "Delete" on your post
   - Confirm deletion
   - Post should be removed

---

### Test 3: Admin Role (Full Access)

**Login Credentials:**
- Email: `admin@example.com`
- Password: `password`

**Expected Behavior:**
1. Logout from editor account
2. Login with admin credentials
3. Go to http://127.0.0.1:8000/blog

**What You Should See:**
- ✅ All blog posts are visible
- ✅ **"Create" button** at the top right
- ✅ **"Edit" button** on **ALL** posts (including those by others)
- ✅ **"Delete" button** on **ALL** posts (including those by others)
- ✅ Full administrative access

**What to Test:**
1. **Create a new post:**
   - Click "Create"
   - Fill in details
   - Submit
   - Should work perfectly

2. **Edit ANY post:**
   - Click "Edit" on a post created by editor@example.com
   - Modify it
   - Save
   - Should update successfully (admin can edit others' posts)

3. **Delete ANY post:**
   - Click "Delete" on any post
   - Confirm
   - Should delete successfully (admin can delete others' posts)

4. **Verify full access:**
   - All CRUD operations should work on all posts
   - No 403 errors

---

## 🎯 Quick Verification Checklist

Use this checklist while testing:

### Viewer Account ✓
- [ ] Can view all posts
- [ ] Cannot see Create button
- [ ] Cannot see Edit buttons
- [ ] Cannot see Delete buttons
- [ ] Gets 403 when accessing /blog/create
- [ ] Gets 403 when accessing /blog/{id}/edit

### Editor Account ✓
- [ ] Can view all posts
- [ ] Can see Create button
- [ ] Can create new posts
- [ ] Can see Edit button on OWN posts only
- [ ] Can see Delete button on OWN posts only
- [ ] Can edit own posts successfully
- [ ] Can delete own posts successfully
- [ ] Gets 403 when trying to edit others' posts
- [ ] Gets 403 when trying to delete others' posts

### Admin Account ✓
- [ ] Can view all posts
- [ ] Can see Create button
- [ ] Can create new posts
- [ ] Can see Edit button on ALL posts
- [ ] Can see Delete button on ALL posts
- [ ] Can edit ANY post successfully
- [ ] Can delete ANY post successfully
- [ ] No 403 errors anywhere

---

## 🔍 Visual Indicators to Look For

### On the Blog Index Page (/blog):

**For each post, you should see:**
```
┌─────────────────────────────────────────────────────┐
│ Post Title                          [Edit] [Delete] │
│ Author Name                                         │
│ Posted by: User Name (role)                        │
└─────────────────────────────────────────────────────┘
```

**Role badges should show:**
- `Posted by: Admin User (Admin)`
- `Posted by: Editor User (Editor)`
- `Posted by: Viewer User (Viewer)`

**Button visibility:**
- Viewer: No buttons
- Editor: Buttons only on own posts
- Admin: Buttons on all posts

### On the Post Show Page (/blog/{id}):

**Top section should have:**
```
┌─────────────────────────────────────────────────────┐
│ Post Title                                          │
│ By Author Name                                      │
│ Posted by: User Name (Role)      [Edit] [Delete]   │
│                                                     │
│ Post content...                                     │
└─────────────────────────────────────────────────────┘
```

---

## 🐛 Common Issues & Solutions

### Issue 1: Not logged in
**Symptom:** Redirected to login page
**Solution:** Make sure you're logged in with one of the test accounts

### Issue 2: All buttons visible to everyone
**Symptom:** Viewer sees Edit/Delete buttons
**Solution:** 
- Clear browser cache
- Check if you're logged in with the correct account
- Verify migrations ran: `php artisan migrate:status`

### Issue 3: 403 errors for admin
**Symptom:** Admin gets 403 when editing posts
**Solution:**
- Check user role in database
- Verify policy is working
- Run: `php artisan tinker` then `User::find(1)->role`

### Issue 4: No Create button for editor
**Symptom:** Editor doesn't see Create button
**Solution:**
- Verify editor role is set correctly
- Check browser console for errors
- Clear cache and reload

---

## 📊 Expected Results Summary

| Action | Viewer | Editor | Admin |
|--------|:------:|:------:|:-----:|
| View /blog | ✅ | ✅ | ✅ |
| See Create button | ❌ | ✅ | ✅ |
| Create post | ❌ 403 | ✅ | ✅ |
| Edit own post | ❌ 403 | ✅ | ✅ |
| Edit others' post | ❌ 403 | ❌ 403 | ✅ |
| Delete own post | ❌ 403 | ✅ | ✅ |
| Delete others' post | ❌ 403 | ❌ 403 | ✅ |

---

## 🎬 Testing Scenarios

### Scenario 1: Editor Ownership Test
1. Login as `editor@example.com`
2. Create a new post titled "Editor's Post"
3. Logout
4. Login as another editor account (create one if needed)
5. Try to edit "Editor's Post"
6. **Expected:** 403 Forbidden (editors can't edit each other's posts)

### Scenario 2: Admin Override Test
1. Login as `editor@example.com`
2. Create a post
3. Logout
4. Login as `admin@example.com`
5. Edit the editor's post
6. **Expected:** Success (admin can edit anyone's posts)

### Scenario 3: Viewer Restriction Test
1. Login as `viewer@example.com`
2. Note a post ID from /blog
3. Try to access `/blog/{id}/edit` directly in browser
4. **Expected:** 403 Forbidden
5. Try to access `/blog/create`
6. **Expected:** 403 Forbidden

---

## 📝 Testing Notes Template

Use this template to document your testing:

```
Date: ___________
Tester: ___________

VIEWER TESTING:
- Login successful: [ ]
- Can view posts: [ ]
- No Create button: [ ]
- No Edit buttons: [ ]
- No Delete buttons: [ ]
- 403 on /blog/create: [ ]
- Notes: ___________

EDITOR TESTING:
- Login successful: [ ]
- Can view posts: [ ]
- Create button visible: [ ]
- Can create post: [ ]
- Edit button on own posts: [ ]
- No edit button on others' posts: [ ]
- Can edit own post: [ ]
- 403 on editing others' posts: [ ]
- Can delete own post: [ ]
- Notes: ___________

ADMIN TESTING:
- Login successful: [ ]
- Can view posts: [ ]
- Create button visible: [ ]
- Can create post: [ ]
- Edit button on ALL posts: [ ]
- Can edit any post: [ ]
- Can delete any post: [ ]
- No 403 errors: [ ]
- Notes: ___________

OVERALL ASSESSMENT:
RBAC System Working: [ ] Yes [ ] No
Issues Found: ___________
```

---

## 🚀 Next Steps After Testing

Once you've verified everything works:

1. **Customize roles** (see CUSTOMIZATION_GUIDE.md)
2. **Add more users** with different roles
3. **Extend to other resources** (comments, tags, etc.)
4. **Add role management UI** for admins
5. **Implement activity logging**

---

**Happy Testing! 🎉**

For detailed technical information, see:
- `RBAC_DOCUMENTATION.md` - Full technical docs
- `RBAC_QUICK_REFERENCE.md` - Code examples
- `RBAC_SUMMARY.md` - Implementation summary
